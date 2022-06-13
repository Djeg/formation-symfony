<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\DTO\SearchCategoryCriteria;
use App\Entity\Category;
use App\Form\AdminCategoryType;
use App\Form\SearchCategoryType;
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
        // Création du formulaire
        $form = $this->createForm(AdminCategoryType::class);

        // On remplie le formulaire avec les données de l'utilisateur
        $form->handleRequest($request);

        // On test si le formulaire est envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // on récupére la catégorie
            $category = $form->getData();

            // Enregistrement en base de données
            $repository->add($category, true);

            return $this->redirectToRoute('app_admin_category_create');
        }

        // afficher le formulaire (la page twig)
        return $this->render('admin/category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/categories', name: 'app_admin_category_list')]
    public function list(CategoryRepository $repository, Request $request): Response
    {
        // Création des critéres de recherche
        $criteria = new SearchCategoryCriteria();

        // Création du formulaire avec les critéres de recherche
        $form = $this->createForm(SearchCategoryType::class, $criteria);

        // On remplie le formulaire avec les données envoyer par l'utilisateur
        $form->handleRequest($request);

        // On récupére toutes les catégories filtré
        $categories = $repository->findByCriteria($criteria);

        // Afficher la page HTML
        return $this->render('admin/category/list.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/categories/{id}', name: 'app_admin_category_update')]
    public function update(Category $category, Request $request, CategoryRepository $repository): Response
    {
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
    public function remove(Category $category, CategoryRepository $repository): Response
    {
        // Supprimer l'categorie de la base de données
        $repository->remove($category, true);

        // Rediriger vers la liste
        return $this->redirectToRoute('app_admin_category_list');
    }
}
