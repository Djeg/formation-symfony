<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\DTO\BookSearchCriteria;
use App\Entity\Book;
use App\Form\BookType;
use App\Form\SearchBookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
	#[Route('/admin/livres', name: 'app_admin_book_list', methods: ['GET'])]
	public function list(BookRepository $repository, Request $request): Response
	{
		$form = $this->createForm(SearchBookType::class, new BookSearchCriteria());

		$form->handleRequest($request);

		$searchCriteria = $form->getData();

		return $this->render('admin/book/list.html.twig', [
			'books' => $repository->findByCriteria($searchCriteria),
			'form' => $form->createView(),
		]);
	}

	#[Route('/admin/livres/nouveau', name: 'app_admin_book_create', methods: ['GET', 'POST'])]
	public function create(Request $request, BookRepository $repository): Response
	{
		$form = $this->createForm(BookType::class, new Book());

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$repository->add($form->getData());

			return $this->redirectToRoute('app_admin_book_list');
		}

		return $this->render('admin/book/create.html.twig', [
			'form' => $form->createView(),
		]);
	}

	#[Route('/admin/livres/{id}/modifier', name: 'app_admin_book_update', methods: ['GET', 'POST'])]
	public function update(Book $book, Request $request, BookRepository $repository): Response
	{
		$form = $this->createForm(BookType::class, $book);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$repository->add($form->getData());

			return $this->redirectToRoute('app_admin_book_list');
		}

		return $this->render('admin/book/update.html.twig', [
			'form' => $form->createView(),
		]);
	}

	#[Route('/admin/livres/{id}/supprimer', name: 'app_admin_book_delete', methods: ['GET'])]
	public function delete(Book $book, BookRepository $repository): Response
	{
		$repository->remove($book);

		return $this->redirectToRoute('app_admin_book_list');
	}

	#[Route('/admin/livres/par-prix/{min}/{max}', name: 'app_admin_book_listByPrice')]
	public function listByPrice(BookRepository $repository, float $min, float $max): Response
	{
		$books = $repository->findByPriceBetween($min, $max);

		return $this->render('admin/book/listByPrice.html.twig', [
			'books' => $books,
		]);
	}

	#[Route('/admin/livres/par-auteur/{authorName}', name: 'app_admin_author_listByAuthorName')]
	public function listByAuthorName(BookRepository $repository, string $authorName): Response
	{
		$books = $repository->findByAuthorName($authorName);

		return $this->render('admin/book/listByAuthorName.html.twig', [
			'books' => $books,
		]);
	}

	#[Route('/admin/livres/par-category/{categoryName}', name: 'app_admin_book_listByCategoryName')]
	public function listByCategoryName(BookRepository $repository, string $categoryName): Response
	{
		$books = $repository->findByCategoryName($categoryName);

		return $this->render('admin/book/listByCategoryName.html.twig', [
			'books' => $books,
		]);
	}
}
