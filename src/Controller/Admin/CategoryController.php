<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/admin/categories/nouveau', name: 'app_admin_category_create')]
    public function create(Request $request, CategoryRepository $repository): Response
    {
        // Tester si le formulaire a était envoyé
        if ($request->isMethod('POST')) {
            // Récupérer les données du formulaire
            $name = $request->request->get('name');

            // Créer l'categorie à partir des données du formulaire
            $category = new Category();
            $category->setName($name);

            // enregistrer l'categorie grâce au répository
            $repository->add($category, true);

            // Rediriger l'utilisateur vers la liste des categories
            return $this->redirectToRoute('app_admin_category_list');
        }

        // afficher le formulaire (la page twig)
        return $this->render('admin/category/create.html.twig');
    }

    #[Route('/admin/categories', name: 'app_admin_category_list')]
    public function list(CategoryRepository $repository): Response
    {
        // Récupérer les categories depuis la base de donnés
        $categories = $repository->findAll();

        // Afficher la page HTML
        return $this->render('admin/category/list.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/admin/categories/{id}', name: 'app_admin_category_update')]
    public function update(int $id, Request $request, CategoryRepository $repository): Response
    {
        // récupérer l'categorie à partir de l'id
        $category = $repository->find($id);

        // Tester si le formulaire à était envoyé
        if ($request->isMethod('POST')) {
            // Récupérer les données rentré dans le formulaire
            $name = $request->request->get('name');

            // Mettre à jour les informations de l'categorie
            $category->setName($name);

            // Enregistrer l'categorie
            $repository->add($category, true);

            // rediriger vers la page liste
            return $this->redirectToRoute('app_admin_category_list');
        }

        // afficher le formulaire de mise à jour de l'categorie
        return $this->render('admin/category/update.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/admin/categories/{id}/supprimer', name: 'app_admin_category_remove')]
    public function remove(int $id, CategoryRepository $repository): Response
    {
        // Récupération de l'categorie depuis son id
        $category = $repository->find($id);

        // Supprimer l'categorie de la base de données
        $repository->remove($category, true);

        // Rediriger vers la liste
        return $this->redirectToRoute('app_admin_category_list');
    }
}
