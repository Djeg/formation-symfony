<?php

namespace App\Controller;

use App\Entity\BookAd;
use App\Entity\User;
use App\Repository\BasketRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Stripe\StripeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
        $this->generateUrl('app_basket_success', [], UrlGeneratorInterface::ABSOLUTE_URL);

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

    #[Route('/mon-panier/payer', name: 'app_basket_pay')]
    public function pay(): Response
    {
        // Je récupére l'utilisateur connécté
        /**
         * @var User
         */
        $user = $this->getUser();

        // Je récupére son panier
        $basket = $user->getBasket();

        // Création du client stripe
        $stripe = new StripeClient('sk_test_bxRlPNBMpA5734i4hzBc0sIA');

        // Création des produits stripe
        $lineItems = [];

        // Je boucle sur tout les livres de mon panier
        foreach ($basket->getBooks() as $book) {
            // Création d'un item
            $item = [
                'quantity' => 1,
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $book->getTitle(),
                    ],
                    'unit_amount' => $book->getPrice() * 100,
                ],
            ];

            // J'ajoute l'item :
            array_push($lineItems, $item);
        }

        // Création du lien de paiment
        $checkout = $stripe->checkout->sessions->create([
            'mode' => 'payment',
            'success_url' => $this->generateUrl('app_basket_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('app_basket_failure', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'line_items' => $lineItems,
        ]);

        // Je redirige vers la page de paiment
        return new RedirectResponse($checkout->url);
    }

    #[Route('/mon-panier/success', name: 'app_basket_success')]
    public function success(): Response
    {
        return new Response('Ok');
    }

    #[Route('/mon-panier/echec', name: 'app_basket_failure')]
    public function failure(): Response
    {
        return new Response('Echec');
    }
}
