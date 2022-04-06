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
#[IsGranted('ROLE_USER')]
#[Route('/panier')]
class BasketController extends AbstractController
{
    /**
     * Ajoute une pizza dans le panier de l'utilisateur
     * connécté
     */
    #[Route('/{id}/ajouter', name: 'app_front_basket_add')]
    public function add(Pizza $pizza, BasketItemRepository $repository): Response
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
        $item->setBasket($basket);
        $item->setPizza($pizza);
        $item->setQuantity(1);

        // On enregistre la panier
        $repository->add($item);

        // On redirige vers la page qui affiche
        // le panier
        return $this->redirectToRoute('app_front_basket_display');
    }

    /**
     * Affiche la totalité du panier
     */
    #[Route('/', name: 'app_front_basket_display')]
    public function display(): Response
    {
        return $this->render('front/basket/display.html.twig');
    }

    /**
     * Permet d'ajouter 1 à la quantité d'un item donnée
     */
    #[Route('/{id}/augmenter', name: 'app_front_basket_increase')]
    public function increase(BasketItem $item, BasketItemRepository $repository): Response
    {
        $item->setQuantity($item->getQuantity() + 1);

        $repository->add($item);

        return $this->redirectToRoute('app_front_basket_display');
    }

    /**
     * Supprime un item du panier
     */
    #[Route('/{id}/supprimer', name: 'app_front_basket_delete')]
    public function delete(BasketItem $item, BasketItemRepository $repository): Response
    {
        $repository->remove($item);

        return $this->redirectToRoute('app_front_basket_display');
    }

    /**
     * Permet d'enlever 1 à la quantité d'un item du panier
     */
    #[Route('/{id}/diminuer', name: 'app_front_basket_decrease')]
    public function decrease(BasketItem $item, BasketItemRepository $repository): Response
    {
        $item->setQuantity($item->getQuantity() - 1);

        if ($item->getQuantity() === 0) {
            return $this->redirectToRoute('app_front_basket_delete', [
                'id' => $item->getId(),
            ]);
        }

        $repository->add($item);

        return $this->redirectToRoute('app_front_basket_display');
    }
}
