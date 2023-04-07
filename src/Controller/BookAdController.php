<?php

namespace App\Controller;

use App\Entity\BookAd;
use App\Entity\User;
use App\Form\NewBookAdType;
use App\Repository\BookAdRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class BookAdController extends AbstractController
{
    #[Route('/vendre-un-livre', name: 'app_book_ad_sell')]
    public function sell(Request $request, BookAdRepository $repository): Response
    {
        // Création du formulaire
        $form = $this->createForm(NewBookAdType::class);

        // On remplie le formulaire
        $form->handleRequest($request);

        // On test la validité du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére le livre
            $bookAd = $form
                ->getData()
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime())
                ->setUser($this->getUser());

            // On l'enregistre dans la base de données
            $repository->save($bookAd, true);

            // On redirige vers la page de profile
            return $this->redirectToRoute('app_profile_show');
        }

        // On affiche le formulaire de cration d'une annonce
        return $this->render('book_ad/sell.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/livres/{id}/modifier', name: 'app_book_ad_update')]
    public function update(BookAd $bookAd, Request $request, BookAdRepository $repository): Response
    {
        // Je récupére l'utilisateur connécté
        /**
         * @var User
         */
        $user = $this->getUser();

        // Je vérifie que le livre appartiennent à l'utilisateur connécté
        if ($bookAd->getUser()->getId() !== $user->getId()) {
            // Si l'utilisateur n'est pas le même alors, je renvoie une 404
            throw new NotFoundHttpException('');
        }

        // Création du formulaire
        $form = $this->createForm(NewBookAdType::class, $bookAd);

        // On remplie le formulaire
        $form->handleRequest($request);

        // On test la validité du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére le livre
            $bookAd = $form
                ->getData()
                ->setUpdatedAt(new DateTime());

            // On l'enregistre dans la base de données
            $repository->save($bookAd, true);

            // On redirige vers la page de profile
            return $this->redirectToRoute('app_profile_show');
        }

        // On affiche le formulaire de modification d'une annonce
        return $this->render('book_ad/update.html.twig', [
            'form' => $form->createView(),
            'book' => $bookAd,
        ]);
    }

    #[Route('/livres/{id}/supprimer', name: 'app_book_ad_remove')]
    public function remove(BookAd $bookAd, BookAdRepository $repository): Response
    {
        // Je récupére l'utilisateur connécté
        /**
         * @var User
         */
        $user = $this->getUser();

        // Je vérifie que le livre appartiennent à l'utilisateur connécté
        if ($bookAd->getUser()->getId() !== $user->getId()) {
            // Si l'utilisateur n'est pas le même alors, je renvoie une 404
            throw new NotFoundHttpException('');
        }

        // on supprime le livre
        $repository->remove($bookAd, true);

        // On redirige vers la page du profil
        return $this->redirectToRoute('app_profile_show');
    }
}
