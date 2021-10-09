<?php

namespace App\Controller;

use App\Class\Cart;
use App\Class\Mail;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface$entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/commande/merci/{stripeSessionId}', name: 'order_validate')]
    public function index(Cart $cart, $stripeSessionId): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$order || $order->getUser() !== $this->getUser()) {
            return $this->redirectToRoute('home');
        }

        if (!$order->getIsPaid()) {
            $cart->remove();

            $order->setIsPaid(1);
            $this->entityManager->flush();

            $mail = new Mail();
            $content = "Bonjour ".$order->getUser()->getFirstname().",<br/><br/>Merci pour votre commande.<br/><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
            $mail->send($order->getUser()->getEmail(), $order->getUser()->getFirstname(), 'Votre commande sur LaGardeRobe.fr est bien validée.', $content);
        }

        return $this->render('order_success/index.html.twig', [
            'order' => $order
        ]);
    }
}
