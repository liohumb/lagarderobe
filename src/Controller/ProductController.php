<?php

namespace App\Controller;

use App\Class\FilterCategory;
use App\Class\FilterGender;
use App\Entity\Product;
use App\Form\FilterGenderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/produits', name: 'products')]
    public function index(Request $request): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        $filterGender = new FilterGender();
        $filterCategory = new FilterCategory();

        $formGender = $this->createForm(FilterGenderType::class, $filterGender);
        $formCategory = $this->createForm(\App\Form\FilterCategoryType::class, $filterCategory);

        $formGender->handleRequest($request);
        $formCategory->handleRequest($request);

        if ($formGender->isSubmitted() && $formGender->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findWithFilterGender($filterGender);
        }

        if ($formCategory->isSubmitted() && $formCategory->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findWithFilterCategory($filterCategory);
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'category' => $formCategory->createView(),
            'gender' => $formGender->createView()
        ]);
    }

    #[Route('/produit/{slug}', name: 'product')]
    public function show($slug): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);

        if (!$product) {
            return $this->redirectToRoute('products');
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
