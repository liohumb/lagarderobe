<?php

namespace App\Class;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Favorite
{
    private SessionInterface $session;
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     */
    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }


    public function add($id): void
    {
        $favorite = $this->session->get('favorite');

        if (!empty($favorite[$id])) {
            $favorite[$id]++;
        } else {
            $favorite[$id] = 1;
        }

        $this->session->set('favorite', $favorite);
    }

    public function get()
    {
        return $this->session->get('favorite');
    }

    public function delete($id)
    {
        $favorite = $this->session->get('favorite');

        unset($favorite[$id]);

        return $this->session->set('favorite', $favorite);
    }

    public function remove()
    {
        return $this->session->remove('favorite');
    }

    public function getFull(): array
    {
        $favoriteComplete = [];

        if ($this->get()) {
            foreach ($this->get() as $id => $quantity) {
                $product_object = $this->entityManager->getRepository(Product::class)->findOneById($id);

                if (!$product_object) {
                    $this->delete($id);
                    continue;
                }

                $favoriteComplete[] = [
                    'product' => $product_object,
                    'quantity' => $quantity
                ];
            }
        }

        return $favoriteComplete;
    }

}