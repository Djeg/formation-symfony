<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\DTO\SearchAuthorCriteria;
use App\Entity\Author;
use App\Form\AdminAuthorType;
use App\Form\SearchAuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/admin/auteurs/nouveau', name: 'app_admin_author_create')]
    public function create(Request $request, AuthorRepository $repository): Response
    {
        // Création du formulaire
        $form = $this->createForm(AdminAuthorType::class);

        // On remplie le formulaire avec les données envoyé par l'utilisateur
        $form->handleRequest($request);

        // Tester si le formulaire est envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // récupération de l'auteur
            $author = $form->getData();

            // enregistrement des données en base de données
            $repository->add($author, true);

            // Redirection vers la page de la liste
            return $this->redirectToRoute('app_admin_author_list');
        }

        // Afficher la page
        return $this->render('admin/author/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/auteurs', name: 'app_admin_author_list')]
    public function list(AuthorRepository $repository, Request $request): Response
    {
        // Création des critères de recherche
        $criteria = new SearchAuthorCriteria();

        // Création du formulaire
        $form = $this->createForm(SearchAuthorType::class, $criteria);

        // On remplie le formulaire avec les données de l'utilisateur
        $form->handleRequest($request);

        // Récupérer les auteurs depuis la base de donnés
        $authors = $repository->findByCriteria($criteria);

        // Afficher la page HTML
        return $this->render('admin/author/list.html.twig', [
            'authors' => $authors,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/auteurs/{id}', name: 'app_admin_author_update')]
    public function update(Author $author, Request $request, AuthorRepository $repository): Response
    {
        // Création du formulaire
        $form = $this->createForm(AdminAuthorType::class, $author);

        // Remplir le formulaire avec les données de l'utilisateur
        $form->handleRequest($request);

        // Tester si le formulaire est envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // récupération de l'auteur
            $author = $form->getData();

            // enregistrement des données en base de données
            $repository->add($author, true);

            // Redirection vers la page de la liste
            return $this->redirectToRoute('app_admin_author_list');
        }

        // Afficher la page
        return $this->render('admin/author/update.html.twig', [
            'form' => $form->createView(),
            'author' => $author,
        ]);
    }

    #[Route('/admin/auteurs/{id}/supprimer', name: 'app_admin_author_remove')]
    public function remove(Author $author, AuthorRepository $repository): Response
    {
        // Supprimer l'auteur de la base de données
        $repository->remove($author, true);

        // Rediriger vers la liste
        return $this->redirectToRoute('app_admin_author_list');
    }
}
