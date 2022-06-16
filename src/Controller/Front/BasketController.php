<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Entity\Book;
use App\Repository\BasketRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class BasketController extends AbstractController
{
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

    #[Route('/mon-panier', name: 'app_front_basket_display')]
    public function display(): Response
    {
        return $this->render('front/basket/display.html.twig');
    }

    #[Route('/mon-panier/{id}/supprimer', name: 'app_front_basket_remove')]
    public function remove(Book $book, BasketRepository $repository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        // On récupére le panier de l'utilisateur connécté
        $basket = $user->getBasket();

        // Suppression du livre du panier
        $basket->removeBook($book);

        // On enregistre la panier
        $repository->add($basket, true);

        // On redirige vers la page d'affichage du panier
        return $this->redirectToRoute('app_front_basket_display');
    }
}
