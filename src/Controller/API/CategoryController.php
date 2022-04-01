<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Form\API\ApiSearchCategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/api/categories', name: 'app_api_category_list', methods: ['GET'])]
    public function list(CategoryRepository $repository, Request $request): Response
    {
        $form = $this->createForm(ApiSearchCategoryType::class);

        $form->handleRequest($request);

        $categories = $repository->findBySearch($form->getData());

        return $this->json($categories);
    }
}
