<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Entity\Category;
use App\Form\API\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
	#[Route('/api/categories', name: 'app_api_category_list', methods: ['GET'])]
	public function list(CategoryRepository $repository): Response
	{
		$categories = $repository->findAll();

		return $this->json($categories);
	}

	#[Route('/api/categories', name: 'app_api_category_create', methods: ['POST'])]
	public function create(Request $request, CategoryRepository $repository): Response
	{
		// Création du formulaire
		$form = $this->createForm(CategoryType::class);

		// On remplie le formulaire
		$form->handleRequest($request);

		// On test si le formulaire à un problème
		if (!$form->isSubmitted() || !$form->isValid()) {
			// Ici on affiche l'erreur
			return $this->json($form->getErrors(true), 400);
		}

		// On enregistre la category en base de données
		$repository->add($form->getData());

		// On affiche la catégory en json
		return $this->json($form->getData(), 201);
	}

	#[Route('/api/categories/{id}', name: 'app_api_category_get', methods: ['GET'])]
	public function get(Category $category): Response
	{
		return $this->json($category);
	}

	#[Route('/api/categories/{id}', name: 'app_api_category_update', methods: ['PUT', 'PATCH'])]
	public function update(
		Category $category,
		CategoryRepository $repository,
		Request $request,
	): Response {
		// Création du formulaire
		$form = $this->createForm(CategoryType::class, $category, [
			'method' => $request->getMethod(),
		]);

		// On remplie le formulaire
		$form->handleRequest($request);

		// On test si le formulaire à une erreur
		if (!$form->isSubmitted() || !$form->isValid()) {
			return $this->json($form->getErrors(true), 400);
		}

		// On enregistre la catégorie
		$repository->add($form->getData());

		// On affiche la catégorie en JSON
		return $this->json($form->getData());
	}

	#[Route('/api/categories/{id}', name: 'app_api_category_delete', methods: ['DELETE'])]
	public function delete(Category $category, CategoryRepository $repository): Response
	{
		$repository->remove($category);

		return $this->json($category);
	}
}
