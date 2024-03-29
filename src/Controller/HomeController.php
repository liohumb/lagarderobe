<?php

namespace App\Controller;

use App\Entity\Hero;
use App\Entity\Information;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController // créé avec symfony console make:controller
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'home')] // Paramètre de route vers la vue
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $heros = $this->entityManager->getRepository(Hero::class)->findAll();
        $informations = $this->entityManager->getRepository(Information::class)->findAll();

        return $this->render('home/index.html.twig', [ // variable à twig
            'products' => $products,
            'heros' => $heros,
            'informations' =>$informations
        ]);
    }
}
