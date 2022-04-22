<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Pizza;
use App\Entity\User;
use App\Form\OrderType;
use App\Repository\CartRepository;
use App\Repository\ItemRepository;
use App\Repository\OrderRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Stripe\Checkout\Session;
use Stripe\OrderReturn;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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

    /**
     * Affiche le formulaire pour finaliser la commande
     */
    #[Route('/commander', name: 'app_frontend_cart_order')]
    #[IsGranted('ROLE_USER')]
    public function order(
        Request $request,
        OrderRepository $repository,
        CartRepository $cartRepository,
    ): Response {

        /**
         * On récupére l'utilisateur actuellement connécté
         * 
         * @var User
         */
        $user = $this->getUser();

        /**
         * On créé une nouvelle commande avec l'adresse de
         * l'utilisateur
         */
        $order = (new Order())
            ->setCity($user->getCity())
            ->setStreet($user->getStreet())
            ->setZipCode($user->getZipCode())
            ->setSupplement($user->getSupplement())
            ->setPhone($user->getPhone())
            ->setUser($user);

        /**
         * On créé un formulaire à partir de la commande
         * créé plus haut
         */
        $form = $this->createForm(OrderType::class, $order);

        /**
         * On remplie le formulaire avec ce que l'utilisateur
         * a spécifié
         */
        $form->handleRequest($request);

        /**
         * On test si le formulaire est envoyé et valide
         */
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * On ajoute les articles du panier à l'intérieur de
             * notre commande
             */
            $items = $user->getCart()->getItems();

            foreach ($items as $item) {
                // On ajoute l'article dans la commande
                $order->addItem($item);
                // On supprime l'article du panier
                $user->getCart()->removeItem($item);
            }

            // On enregistre la commande
            $repository->add($order);
            // On enregistre le panier
            $cartRepository->add($user->getCart());

            // On peut passer au système de paiement !

            // 1. On connécte stripe
            Stripe::setApiKey('sk_test_bxRlPNBMpA5734i4hzBc0sIA');

            // On récupére les items stripe que l'on veur vendre
            $items = [];

            foreach ($order->getItems() as $item) {
                $items[] = [
                    'quantity' => $item->getQuantity(),
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item->getPizza()->getTitle(),
                        ],
                        'unit_amount' => $item->getPizza()->getPrice() * 100,
                    ]
                ];
            }

            /**
             * On génére une url de paiment stripe. Pour cela
             * il faut indiquer les articles à vendre dans
             * 'line_items', l'url de success si le paiment
             * c'est bien passé et l'url d'erreur si une erreur
             * est survenue durant le paiment.
             */
            $checkout = Session::create([
                'line_items' => $items,
                'mode' => 'payment',
                'success_url' => $this->generateUrl('app_frontend_cart_success', [
                    'id' => $order->getId(),
                ], UrlGeneratorInterface::ABSOLUTE_URL),
                'cancel_url' => $this->generateUrl('app_frontend_cart_error', [
                    'id' => $order->getId(),
                ], UrlGeneratorInterface::ABSOLUTE_URL),
            ]);

            /**
             * On redirige vers la page de paiment stripe
             */
            return $this->redirect($checkout->url);
        }

        return $this->render('frontend/cart/order.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/commandes/{id}/confirmation', name: 'app_frontend_cart_success')]
    #[IsGranted('ROLE_USER')]
    public function success(Order $order, OrderRepository $repository): Response
    {
        $order->setStatus(Order::$STATUS_COOKING);

        $repository->add($order);

        return $this->render('frontend/cart/success.html.twig');
    }

    #[Route('/commandes/{id}/erreurs', name: 'app_frontend_cart_error')]
    #[IsGranted('ROLE_USER')]
    public function error(Order $order, OrderRepository $repository): Response
    {
        $order->setStatus(Order::$STATUS_CANCEL);

        $repository->add($order);

        return $this->render('frontend/cart/error.html.twig');
    }
}
