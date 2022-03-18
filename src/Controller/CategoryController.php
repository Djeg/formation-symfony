<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories/nouveau', name: 'app_category_create')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        if ($request->isMethod('GET')) {
            return $this->render('category/create.html.twig');
        }

        $category = new Category();
        $category->setName($request->request->get('name'));

        $manager->persist($category);

        $manager->flush();

        return $this->redirectToRoute('app_category_list');
    }

    #[Route('/categories', name: 'app_category_list')]
    public function list(CategoryRepository $repository): Response
    {
        $categories = $repository->findAll();

        return $this->render('category/list.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/categories/{id}/modifier', name: 'app_category_update')]
    public function update(Request $request, EntityManagerInterface $manager, CategoryRepository $repository, int $id): Response
    {
        // Récupération d'un categorie par son id
        $category = $repository->find($id);

        // On test si le categorie éxiste
        if (!$category) {
            // retour d'une réponse 404
            return new Response("Le categorie n'éxiste pas", 404);
        }

        if ($request->isMethod('GET')) {
            return $this->render('category/update.html.twig', ['category' => $category]);
        }

        $category->setName($request->request->get('name'));

        $manager->persist($category);
        $manager->flush();

        return $this->redirectToRoute('app_category_list');
    }

    #[Route('/categories/{id}/supprimer', name: 'app_category_remove')]
    public function remove(
        CategoryRepository $repository,
        EntityManagerInterface $manager,
        int $id,
    ): Response {
        // Récupération d'un categorie
        $category = $repository->find($id);

        // On test si le categorie éxiste
        if (!$category) {
            // retour d'une réponse 404
            return new Response("Le categorie n'éxiste pas", 404);
        }

        $manager->remove($category);
        $manager->flush();

        return $this->redirectToRoute('app_category_list');
    }
}
