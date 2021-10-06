<?php

namespace App\Controller;

use App\Class\Mail;
use App\Entity\Comment;
use App\Entity\Hero;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $heros = $this->entityManager->getRepository(Hero::class)->findAll();
        $comments = $this->entityManager->getRepository(Comment::class)->findByIsBest(1);

        return $this->render('home/index.html.twig', [
            'products' => $products,
            'heros' => $heros,
            'comments' => $comments
        ]);
    }
}
