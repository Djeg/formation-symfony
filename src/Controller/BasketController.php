<?php

namespace App\Controller;

use App\Entity\BookAd;
use App\Entity\User;
use App\Repository\BasketRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class BasketController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_basket_show')]
    public function show(): Response
    {
        return $this->render('basket/show.html.twig');
    }

    #[Route('/mon-panier/ajouter/{id}', name: 'app_basket_add')]
    public function add(BookAd $book, BasketRepository $repository): Response
    {
        // Je récupére l'utilisateur connécté
        /**
         * Ceci est un commentaire de documentation. Ici, ce commentaire
         * permet à vscode de force le type d'une variable. Ici : User
         * 
         * @var User
         */
        $user = $this->getUser();

        // Je récupére son panier
        $basket = $user->getBasket();

        // J'ajoute le livre dans le panier
        $basket->addBook($book);

        // J'enregistre le panier
        $repository->save($basket, true);

        // Je redirige vers la page du panier
        return $this->redirectToRoute('app_basket_show');
    }

    #[Route('/mon-panier/supprimer/{id}', name: 'app_basket_remove')]
    public function remove(BookAd $book, BasketRepository $repository): Response
    {
        /**
         * @var User
         */
        $user = $this->getUser();

        // Je récupére son panier
        $basket = $user->getBasket();

        // Je supprime le livre du panier
        $basket->removeBook($book);

        // J'enregistre le panier
        $repository->save($basket, true);

        // Je redirige vers la page du panier
        return $this->redirectToRoute('app_basket_show');
    }
}
