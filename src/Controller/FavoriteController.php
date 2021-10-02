<?php

namespace App\Controller;

use App\Class\Favorite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends AbstractController
{
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/favoris', name: 'favorite')]
    public function index(Favorite $favorite): Response
    {
        return $this->render('favorite/index.html.twig', [
            'favorite' => $favorite->getFull()
        ]);
    }


    #[Route('/favorite/add/{id}', name: 'add_to_favorite')]
    public function add(Favorite $favorite, $id): Response
    {
        $favorite->add($id);

        return $this->redirectToRoute('favorite');
    }


    #[Route('/favorite/delete{id}', name: 'delete_to_favorite')]
    public function delete(Favorite $favorite, $id): Response
    {
        $favorite->delete($id);

        return $this->redirectToRoute('favorite');
    }


    #[Route('/favorite/remove', name: 'remove_my_favorite')]
    public function remove(Favorite $favorite): Response
    {
        $favorite->remove();

        return $this->redirectToRoute('products');
    }
}

