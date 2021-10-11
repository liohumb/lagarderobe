<?php

namespace App\Controller;

use App\Class\Mail;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController // crée avec la commande symfony console make:controller
{
    private EntityManagerInterface $entityManager; // variable de l'entityManager, le manager de doctrine qui nous sert à faire nos manipulations

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager) // constructeur de l'entityManager
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/inscription', name: 'register')]
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response // Request, soit une injection de dépendance. On dit de rentrer dans la public function index en embarquant la request
    {                                                                                        // UserPasswordEncoderInterface, encodeur de mot de passe
        $notification = null;

        $user = new User(); // J'instencie la class User
        $form = $this->createForm(RegisterType::class, $user); // J'instencie la class du Formulaire

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) { // condition pour savoir si le formulaire est valide et qui va nous permettre de continuer
            $user = $form->getData(); // On injecte toutes les données du formulaire dans l'entity user

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if (!$search_email) {
                $password = $encoder->encodePassword($user, $user->getPassword()); // on appelle à l'UserPasswordEncoderInterface qui va permettre de crypter le password

                $user->setPassword($password); // On réinjecte le password encodé dans l'entity User

                $this->entityManager->persist($user); // Persist, soit ficher la data. Ici User
                $this->entityManager->flush(); // Flush, soit tu l'enregistres dans la base de données

                $mail = new Mail();
                $content = "Bonjour ".$user->getFirstname().",<br/>Bienvenue sur la première boutique Femme, Homme & Bébé entièrement made in France.<br/><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
                $mail->send($user->getEmail(), $user->getFirstname(), 'Bienvenue sur LaGardeRobe.fr', $content);

                $notification = "Votre inscription s'est correctement déroulée. Vous pouvez dès à présent vous connecter à votre compte.";
            } else {
                $notification = "L'email que vous avez renseigné est déjà associé à un compte sur LaGardeRobe.fr";
            }
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(), // Création de la vue du formulaire
            'notification' => $notification
        ]);
    }
}
