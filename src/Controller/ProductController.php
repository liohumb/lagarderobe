<?php

namespace App\Controller;

use App\Class\Filter;
use App\Class\FilterBaby;
use App\Class\FilterMen;
use App\Class\FilterWomen;
use App\Entity\Product;
use App\Form\FilterBabyType;
use App\Form\FilterMenType;
use App\Form\FilterWomenType;
use App\Form\FilterType;
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

        $filter = new Filter();
        $form = $this->createForm(FilterType::class, $filter);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findWithFilter($filter);
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }

    #[Route('/produits/femme', name: 'productsWomen')]
    public function women(Request $request): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findBy(['gender' => 1]);

        $filterWomen = new FilterWomen();
        $formWomen = $this->createForm(FilterWomenType::class, $filterWomen);

        $formWomen->handleRequest($request);

        if ($formWomen->isSubmitted() && $formWomen->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findWithFilterWomen($filterWomen);
        }

        return $this->render('product/women.html.twig', [
            'products' => $products,
            'form' => $formWomen->createView()
        ]);
    }

    #[Route('/produits/homme', name: 'productsMen')]
    public function men(Request $request): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findBy(['gender' => 2]);

        $filterMen = new FilterMen();
        $formMen = $this->createForm(FilterMenType::class, $filterMen);

        $formMen->handleRequest($request);

        if ($formMen->isSubmitted() && $formMen->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findWithFilterMen($filterMen);
        }

        return $this->render('product/men.html.twig', [
            'products' => $products,
            'form' => $formMen->createView()
        ]);
    }

    #[Route('/produits/bebe', name: 'productsBaby')]
    public function baby(Request $request): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findBy(['gender' => 3]);

        $filterBaby = new FilterBaby();
        $formBaby = $this->createForm(FilterBabyType::class, $filterBaby);

        $formBaby->handleRequest($request);

        if ($formBaby->isSubmitted() && $formBaby->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findWithFilterBaby($filterBaby);
        }

        return $this->render('product/baby.html.twig', [
            'products' => $products,
            'form' => $formBaby->createView()
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
