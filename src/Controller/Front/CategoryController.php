<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Entity\Category;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories/{id}', name: 'app_front_category_display')]
    public function display(Category $category, BookRepository $repository): Response
    {
        // Récupération des livres de la base de données
        $books = $repository->findAllByCategory($category->getId());

        // Afficher la page d'une catégorie
        return $this->render('front/category/display.html.twig', [
            'books' => $books,
            'category' => $category,
        ]);
    }
}
