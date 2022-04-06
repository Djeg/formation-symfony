<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Entity\BasketItem;
use App\Entity\Pizza;
use App\Repository\BasketItemRepository;
use App\Repository\BasketRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controlleur contient toutes les routes
 * du panier d'un utilisateur. Nous pouvons,
 * ajouter, supprimer et commander un panier.
 */
class BasketController extends AbstractController
{
    /**
     * Ajoute une pizza dans le panier de l'utilisateur
     * connécté
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/panier/{id}/ajouter', name: 'app_front_basket_add')]
    public function add(Pizza $pizza, BasketRepository $repository): Response
    {
        // Récupére l'utilisateur connécté
        /** @var User */
        $user = $this->getUser();

        // Récupération du panier
        $basket = $user->getBasket();

        // Créer un item que je vais rajouter à mon panier.
        // cette item doit être attaché à la pizza
        // et doit avoir une quantité de 1
        $item = new BasketItem();
        $item->setPizza($pizza);
        $item->setQuantity(1);

        // On rajoute l'item dans le panier
        $basket->addBasketItem($item);

        // On enregistre la panier
        $repository->add($basket);

        // On redirige vers la page qui affiche
        // le panier
        return $this->redirectToRoute('app_front_basket_display');
    }
}
