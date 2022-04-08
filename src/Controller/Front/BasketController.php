<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\DTO\Paiment;
use App\Entity\BasketItem;
use App\Entity\Order;
use App\Entity\Pizza;
use App\Entity\User;
use App\Form\OrderType;
use App\Repository\BasketItemRepository;
use App\Repository\BasketRepository;
use App\Repository\OrderRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * Permet de commander ce que l'on as dans notre panier.
     * Cette méthode utilise un formulaire contenant les informations
     * de carte bleu de l'utilisateur. Ici nous n'en faisont rien
     * mais nous pourrions très bien utilisé un service bancaire
     * pour procéder au paiement :)
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/commander', name: 'app_front_basket_order')]
    public function order(
        Request $request,
        OrderRepository $repository,
        BasketRepository $basketRepository,
    ): Response {
        /** @var User */
        $user = $this->getUser();
        $basket = $user->getBasket();

        // Nous commencons par créer le DTO contenant les
        // informations de paiment
        $paiment = new Paiment();
        $paiment->address = $user->getAddress();

        // Maintenant nous créons le formulaire pour le paiment
        $form = $this->createForm(OrderType::class, $paiment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si le formulaire est valide alors nous pouvons
            // créer le commande :)
            $order = new Order();
            $order->setUser($user);
            $order->setAddress($paiment->address);

            foreach ($basket->getBasketItems() as $item) {
                $order->addItem($item);
            }

            // Ici nous pourrions procéder au paiment en utilisant
            // le DTO du formulaire et les informations de la carte
            // bleu. ATTENTION : Il est interdit d'enregistrer les informations
            // de cette carte bleu en base de données !!!
            $repository->add($order);

            // Pour finir nous vidons le panier et l'enregistrons en base
            $basket->empty();
            $basketRepository->add($basket);

            return $this->redirectToRoute('app_front_basket_orderConfirmation', [
                'id' => $order->getId(),
            ]);
        }

        return $this->render('front/basket/order.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Affiche la page de confirmation d'une commande
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/confirmation', name: 'app_front_basket_orderConfirmation')]
    public function orderConfirmation(Order $order): Response
    {
        return $this->render('front/basket/orderConfirmation.html.twig', [
            'order' => $order,
        ]);
    }
}
