<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
	#[Route('/admin/livres', name: 'app_admin_book_list', methods: ['GET'])]
	public function list(BookRepository $repository): Response
	{
		return $this->render('admin/book/list.html.twig', [
			'books' => $repository->findAll(),
		]);
	}
}
