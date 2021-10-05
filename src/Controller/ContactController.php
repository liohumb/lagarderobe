<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/contact', name: 'contact')]
    public function index(Request $request): Response
    {
        $notification = null;

        $message = new Message();
        $form = $this->createForm(ContactType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('notice', 'Merci de nous avoir contacté. Notre équipe va vous répondre dans les meilleurs délais.');

            $message = $form->getData();

            $this->entityManager->persist($message);
            $this->entityManager->flush();

            $notification ='Votre message à bien été envoyé, merci et à très vite !';
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
