<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
	public function create(): Response
	{
	}
}
