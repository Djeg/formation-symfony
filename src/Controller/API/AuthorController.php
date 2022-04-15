<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\DTO\AuthorSearchCriteria;
use App\Entity\Author;
use App\Form\API\AuthorType;
use App\Form\SearchAuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
	#[Route('/api/auteurs', name: 'app_api_author_list', methods: ['GET'])]
	public function list(AuthorRepository $repository, Request $request): Response
	{
		$form = $this->createForm(SearchAuthorType::class, new AuthorSearchCriteria());

		$form->handleRequest($request);

		$criterias = $form->isSubmitted() && $form->isValid()
			? $form->getData()
			: new AuthorSearchCriteria();

		$authors = $repository->findByCriteria($criterias);

		return $this->json($authors);
	}

	#[Route('/api/auteurs', name: 'app_api_author_create', methods: ['POST'])]
	public function create(Request $request, AuthorRepository $repository): Response
	{
		$form = $this->createForm(AuthorType::class, new Author());

		$form->handleRequest($request);

		if (!$form->isSubmitted() && !$form->isValid()) {
			return $this->json($form->getErrors(true), 400);
		}

		$repository->add($form->getData());

		return $this->json($form->getData());
	}

	#[Route('/api/auteurs/{id}', name: 'app_api_author_get', methods: ['GET'])]
	public function get(Author $author): Response
	{
		return $this->json($author);
	}

	#[Route('/api/auteurs/{id}', name: 'app_api_author_update', methods: ['PATCH'])]
	public function update(Author $author, AuthorRepository $repository, Request $request): Response
	{
		$form = $this->createForm(AuthorType::class, $author, [
			'method' => 'PATCH',
		]);

		$form->handleRequest($request);

		if (!$form->isSubmitted() && !$form->isValid()) {
			return $this->json($form->getErrors(true), 400);
		}

		$repository->add($form->getData());

		return $this->json($form->getData());
	}

	#[Route('/api/auteurs/{id}', name: 'app_api_author_delete', methods: ['DELETE'])]
	public function delete(Author $author, AuthorRepository $repository): Response
	{
		$repository->remove($author);

		return $this->json($author);
	}
}
