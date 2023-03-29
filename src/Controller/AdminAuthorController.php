<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorSearchType;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
class AdminAuthorController extends AbstractController
{
    /**
     * Liste toute les auteurs de l'application
     */
    #[Route('/admin/auteurs', name: 'app_admin_author_list')]
    public function list(AuthorRepository $repository, Request $request): Response
    {
        // Je créé le formulaire de recherche des auteurs
        $form = $this->createForm(AuthorSearchType::class);

        // On remplie avec les données de l'utilisateur
        $form->handleRequest($request);

        // Dans le cas d'un formulaire de recherche, nous n'avons pas besoin
        // de tester la soumission et la validité !
        // Il suffit juste de récupérer le DTO (AuthorSearchCriteria) et l'envoyé
        // à notre repository afin de lancer une recherche
        $criteria = $form->getData();

        // Je récupére toutes les auteurs filtré par les critères de recherche :
        $authors = $repository->findAllByCriteria($criteria);

        // J'affiche la liste des auteurs
        return $this->render('admin_author/list.html.twig', [
            'authors' => $authors,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Création d'un auteur
     */
    #[Route('/admin/auteurs/creation', name: 'app_admin_author_create')]
    public function create(Request $request, AuthorRepository $repository): Response
    {
        // je créé le formulaire
        $form = $this->createForm(AuthorType::class);

        // je remplie le formulaire avec les données saisie par l'utilisateur
        $form->handleRequest($request);

        // je test si le formulaire a bien était envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Je récupére l'auteur du formulaire
            $author = $form
                ->getData()
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime());

            // J'enregistre l'auteur dans la base de données
            $repository->save($author, true);

            // je redirige vers la liste des auteurs
            return $this->redirectToRoute('app_admin_author_list');
        }

        // j'affiche le formulaire de création d'un auteur
        return $this->render('admin_author/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modifie un auteur
     */
    #[Route('/admin/auteurs/{id}', name: 'app_admin_author_update')]
    public function update(Request $request, AuthorRepository $repository, Author $author)
    {
        // je créé le formulaire avec l'auteur
        $form = $this->createForm(AuthorType::class, $author);

        // je remplie le formulaire avec les données saisie par l'utilisateur
        $form->handleRequest($request);

        // je test si le formulaire a bien était envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // J'enregistre l'auteur dans la base de données
            $repository->save($author->setUpdatedAt(new DateTime()), true);

            // je redirige vers la liste des auteurs
            return $this->redirectToRoute('app_admin_author_list');
        }

        // j'affiche le formulaire de création d'un auteur
        return $this->render('admin_author/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime un auteur
     */
    #[Route('/admin/auteurs/{id}/supprimer', name: 'app_admin_author_remove')]
    public function remove(Author $author, AuthorRepository $repository): Response
    {
        // Je supprime l'auteur
        $repository->remove($author, true);

        // Je redirige vers la liste des auteurs
        return $this->redirectToRoute('app_admin_author_list');
    }
}
