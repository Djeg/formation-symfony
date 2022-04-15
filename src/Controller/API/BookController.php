<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\DTO\BookSearchCriteria;
use App\Entity\Book;
use App\Form\API\BookType;
use App\Form\SearchBookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends BaseController
{
	#[Route('/api/livres', name: 'app_api_book_list', methods: ['GET'])]
	public function list(BookRepository $repository, Request $request): Response
	{
		return $this->listEntities(
			SearchBookType::class,
			new BookSearchCriteria(),
			$repository,
		);
	}

	#[Route('/api/livres', name: 'app_api_book_create', methods: ['POST'])]
	public function create(Request $request, BookRepository $repository): Response
	{
		$form = $this->createForm(BookType::class, new Book());

		$form->handleRequest($request);

		if (!$form->isSubmitted() && !$form->isValid()) {
			return $this->json($form->getErrors(true), 400);
		}

		$repository->add($form->getData());

		return $this->json($form->getData());
	}

	#[Route('/api/livres/{id}', name: 'app_api_book_get', methods: ['GET'])]
	public function get(Book $book): Response
	{
		return $this->json($book);
	}

	#[Route('/api/livres/{id}', name: 'app_api_book_update', methods: ['PATCH'])]
	public function update(Book $book, BookRepository $repository, Request $request): Response
	{
		$form = $this->createForm(BookType::class, $book, [
			'method' => 'PATCH',
		]);

		$form->handleRequest($request);

		if (!$form->isSubmitted() && !$form->isValid()) {
			return $this->json($form->getErrors(true), 400);
		}

		$repository->add($form->getData());

		return $this->json($form->getData());
	}

	#[Route('/api/livres/{id}', name: 'app_api_book_delete', methods: ['DELETE'])]
	public function delete(Book $book, BookRepository $repository): Response
	{
		$repository->remove($book);

		return $this->json($book);
	}
}
