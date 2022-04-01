<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Entity\Category;
use App\Form\API\ApiCategoryType;
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

    #[Route('/api/categories', name: 'app_api_category_create', methods: ['POST'])]
    public function create(Request $request, CategoryRepository $repository): Response
    {
        $form = $this->createForm(ApiCategoryType::class, new Category(), [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->json($form->getErrors(), 400);
        }

        $repository->add($form->getData());

        return $this->json($form->getData(), 201);
    }

    #[Route('/api/categories/{id}', name: 'app_api_category_update', methods: ['PATCH'])]
    public function update(Category $category, Request $request, CategoryRepository $repository): Response
    {
        $form = $this->createForm(ApiCategoryType::class, $category, [
            'method' => 'PATCH',
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->json($form->getErrors(), 400);
        }

        $repository->add($form->getData());

        return $this->json($form->getData());
    }

    #[Route('/api/categories/{id}', name: 'app_api_category_delete', methods: ['DELETE'])]
    public function delete(Category $category, CategoryRepository $repository): Response
    {
        $repository->remove($category);

        return $this->json($category);
    }
}
