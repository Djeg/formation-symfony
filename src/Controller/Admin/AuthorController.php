<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{
	#[Route('/admin/auteurs', name: 'app_admin_author_list', methods: ['GET'])]
	public function list(AuthorRepository $repository): Response
	{
		// Récupération de tout les auteurs
		$authors = $repository->findAll();

		return $this->render('admin/author/list.html.twig', [
			'authors' => $authors,
		]);
	}

	#[Route('/admin/auteurs/nouveau', name: 'app_admin_author_create', methods: ['GET', 'POST'])]
	public function create(Request $request, AuthorRepository $repository): Response
	{
		// Création d'un formulaire :
		$form = $this->createForm(AuthorType::class, new Author());

		// On remplie notre formulaire avec les données de request si il y en as
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// Enregistrer notre en base données
			$repository->add($form->getData());

			// Rediriger vers la liste des auteurs
			return $this->redirectToRoute('app_admin_author_list');
		}

		// On affiche le template avec le formulaire
		return $this->render('admin/author/create.html.twig', [
			'form' => $form->createView(),
		]);
	}

	#[Route('/admin/auteurs/{id}/modifier', name: 'app_admin_author_update', methods: ['GET', 'POST'])]
	public function update(Author $author, Request $request, AuthorRepository $repository): Response
	{
		// Création d'un formulaire :
		$form = $this->createForm(AuthorType::class, $author);

		// On remplie notre formulaire avec les données de request si il y en as
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// Enregistrer notre en base données
			$repository->add($form->getData());

			// Rediriger vers la liste des auteurs
			return $this->redirectToRoute('app_admin_author_list');
		}

		// On affiche le template avec le formulaire
		return $this->render('admin/author/update.html.twig', [
			'form' => $form->createView(),
		]);
	}

	#[Route('/admin/auteurs/{id}/supprimer', name: 'app_admin_author_delete')]
	public function delete(Author $author, AuthorRepository $repository): Response
	{
		$repository->remove($author);

		return $this->redirectToRoute('app_admin_author_list');
	}
}
