<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\Item;
use App\Entity\Pizza;
use App\Entity\User;
use App\Repository\CartRepository;
use App\Repository\ItemRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * Affiche le panier de l'utilisateur connécté
     */
    #[Route('/mon-panier', name: 'app_frontend_cart_display')]
    #[IsGranted('ROLE_USER')]
    public function display(): Response
    {
        return $this->render('frontend/cart/display.html.twig');
    }

    /**
     * Augmente de 1 la quantity de l'item (pizza) demandé
     */
    #[Route('/mon-panier/{id}/augmenter', name: 'app_frontend_cart_increment')]
    #[IsGranted('ROLE_USER')]
    public function increment(Item $item, ItemRepository $repository): Response
    {
        $item->setQuantity($item->getQuantity() + 1);

        $repository->add($item);

        return $this->redirectToRoute('app_frontend_cart_display');
    }

    /**
     * Diminue de 1 la quantité de l'item (pizza) demandé
     */
    #[Route('/mon-panier/{id}/diminuer', name: 'app_frontend_cart_decrement')]
    #[IsGranted('ROLE_USER')]
    public function decrement(Item $item, ItemRepository $repository): Response
    {
        $item->setQuantity($item->getQuantity() - 1);

        if ($item->getQuantity() <= 0) {
            return $this->redirectToRoute('app_frontend_cart_remove', [
                'id' => $item->getId(),
            ]);
        }

        $repository->add($item);

        return $this->redirectToRoute('app_frontend_cart_display');
    }

    /**
     * Supprime un item du panier
     */
    #[Route('/mon-panier/{id}/supprimer', name: 'app_frontend_cart_remove')]
    #[IsGranted('ROLE_USER')]
    public function remove(Item $item, CartRepository $repository): Response
    {
        /** @var User */
        $user = $this->getUser();
        $cart = $user->getCart();

        $cart->removeItem($item);

        $repository->add($cart);

        return $this->redirectToRoute('app_frontend_cart_display');
    }

    /**
     * Ajoute une nouvelle pizza au panier
     */
    #[Route('/mon-panier/{id}/ajouter', name: 'app_frontend_cart_add')]
    #[IsGranted('ROLE_USER')]
    public function add(Pizza $pizza, CartRepository $repository): Response
    {
        /** @var User */
        $user = $this->getUser();
        $cart = $user->getCart();

        $item = new Item();
        $item->setQuantity(1);
        $item->setPizza($pizza);

        $cart->addItem($item);

        $repository->add($cart);

        return $this->redirectToRoute('app_frontend_cart_display');
    }
}
