<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Entity\Book;
use App\Repository\BasketRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/mon-panier/{id}/ajouter', name: 'app_front_basket_add')]
    public function add(Book $book, BasketRepository $repository): Response
    {
        // recupération de l'utilisateur connécté
        /** @var User $user */
        $user = $this->getUser();
        // Récupération du panier
        $basket = $user->getBasket();

        // Ajout du livre dans le panier
        $basket->addBook($book);

        // Enregistrement du panier
        $repository->add($basket, true);

        return $this->redirectToRoute('app_front_basket_display');
    }
}
