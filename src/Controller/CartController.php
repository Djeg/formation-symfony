<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Ad;
use App\Repository\AdRepository;
use App\Repository\CartRepository;
use App\Service\Payment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Contient toutes les pages concernant le panier. Ce controller
 * n'est accessible qu'au utilisateur ayant le ROLE_USER au moins ! 
 * 
 * Ainsi, il est impossible pour un utilisateur non connécté d'accéder à
 * ce controller. Cela est possible grâce à l'attribut `IsGranted`.
 * 
 * Vous pouvez utiliser cette attribut php sur n'importe quelle controller,
 * mais aussi sur une méthod spécifique du controller
 */
#[IsGranted('ROLE_USER')]
class CartController extends AbstractController
{
    /**
     * Ajoute une annonce dans la panier de l'utilisateur connécté.
     * 
     * Puisque nous avons utilisé l'attribut « IsGranted », cette méthode
     * est uniquement réserver aux utilisateurs connécté !
     */
    #[Route('/mon-panier/{id}/ajouter', name: 'app_cart_add', methods: ['GET'])]
    public function add(Ad $ad, CartRepository $repository): Response
    {
        /**
         * @var Account
         * 
         * Récupére l'utilisateur actuellement connécté. 
         * 
         * Attention cela peut renvoyer « null ». En effet, dans
         * le cas d'un controller accessible à tous et même aux
         * utilisateur non connécté, $this->getUser() retourne « null »
         * pour ceux qui ne sont pas connécté.
         */
        $account = $this->getUser();

        // je récupére le panier de l'utilisateur connécté
        $cart = $account->getCart();

        // j'ajoute l'annonce dans le panier
        $cart->addAd($ad);

        // j'enregistre le panier
        $repository->save($cart, true);

        // Je redirige vers la page du panier
        return $this->redirectToRoute('app_cart_show');
    }

    /**
     * Suppression d'une annonce du panier
     */
    #[Route('/mon-panier/{id}/supprimer', name: 'app_cart_remove', methods: ['GET'])]
    public function remove(Ad $ad, CartRepository $repository): Response
    {
        /**
         * @var Account
         */
        $account = $this->getUser();

        // je récupére le panier de l'utilisateur connécté
        $cart = $account->getCart();

        // je supprime l'annonce dans le panier
        $cart->removeAd($ad);

        // j'enregistre le panier
        $repository->save($cart, true);

        // Je redirige vers la page du panier
        return $this->redirectToRoute('app_cart_show');
    }

    /**
     * Affiche le contenue du panier
     */
    #[Route('/mon-panier', name: 'app_cart_show', methods: ['GET'])]
    public function show(TranslatorInterface $translator): Response
    {
        // traduction du mot clef « my_cart ». La langue utilisé par
        // la traduction est celle du client. Si aucune traduction
        // n'est disponible alors la langue par défaut est utilisé :
        // config/packages/translations.yaml => default_locale
        $translation = $translator->trans('my_cart');

        // on affiche la page
        return $this->render('cart/show.html.twig', [
            'translation' => $translation,
        ]);
    }

    /**
     * Valide un paiement et redirige sur stripe.
     * Pour cela nous utilisons notre propres service : Payment.
     * 
     * Nous injéctons aussi le service de validation afin de
     * valider le panier en utilisant ces propres contraintes
     */
    #[Route('/mon-panier/validation', name: 'app_cart_validate', methods: ['GET'])]
    public function validate(Payment $payment, ValidatorInterface $validator): Response
    {
        /**
         * @var Account
         */
        $account = $this->getUser();

        // Nous validons le panier en premier temps
        $cart = $account->getCart();
        $errors = $validator->validate($cart);

        // Si il y a des erreurs :
        if (count($errors) > 0) {
            // Nous redirigons vers la page du panier
            return $this->redirectToRoute('app_cart_show', [
                'errors' => $errors,
            ]);
        }

        // On redirige vers l'url stripe
        return $this->redirect($payment->checkout($this->getUser()));
    }

    /**
     * Page de confirmation d'un paiement (tout c'est passé)
     */
    #[Route('/mon-panier/confirmation', name: 'app_cart_confirm', methods: ['GET'])]
    public function confirm(CartRepository $cartRepository, AdRepository $adRepository): Response
    {
        /**
         * @var Account
         */
        $account = $this->getUser();

        // je supprime les annonces du panier et de la base de données
        foreach ($account->getCart()->getAds() as $ad) {
            $adRepository->remove($ad);
            $account->getCart()->removeAd($ad);
        }

        // je sauvegarde le panier
        $cartRepository->save($account->getCart(), true);

        return $this->render('cart/confirm.html.twig');
    }

    /**
     * page d'erreur de paiement
     */
    #[Route('/mon-panier/paiement-error', name: 'app_cart_error', methods: ['GET'])]
    public function error(): Response
    {
        return $this->render('cart/error.html.twig');
    }
}
