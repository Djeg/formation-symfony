<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryAdminController extends AbstractController
{
    #[Route('/admin/categories/nouveau', name: 'app_admin_categoryAdmin_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        // si la méthode HTTP est GET (obtenir)
        if ($request->isMethod('GET')) {
            // Affichage de la page de création d'une categorie
            return $this->render('admin/categoryAdmin/create.html.twig');
        }

        // si la méthode HTTP est POST (créer)

        // Création du nouveau categorie
        $category = (new Category())
            ->setName($request->request->get('name'));

        // Enregistrement, persistence du nouveau categorie
        $manager->persist($category);
        $manager->flush();

        // Redirection vers la page de la liste des categories
        return $this->redirectToRoute('app_admin_categoryAdmin_retrieve');
    }

    #[Route('/admin/categories', name: 'app_admin_categoryAdmin_retrieve', methods: ['GET'])]
    public function retrieve(CategoryRepository $repository): Response
    {
        // Récupérer tout les categories depuis le repository
        $categories = $repository->findAll();

        // Affichage de tout les categories
        return $this->render('admin/categoryAdmin/retrieve.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/admin/categories/{id}/modifier', name: 'app_admin_categoryAdmin_update', methods: ['GET', 'POST'])]
    public function update(
        int $id,
        Request $request,
        CategoryRepository $repository,
        EntityManagerInterface $manager,
    ): Response {
        // Récupération du categorie par son id
        $category = $repository->find($id);

        // Si le categorie n'existe pas
        if (!$category) {
            // On retourne une page 404
            return new Response("Le categorie n'éxiste pas", 404);
        }

        // Si la méthode HTTP est GET (obtenir)
        if ($request->isMethod('GET')) {
            // Affichage du formulaire de mise à jour du categorie
            return $this->render('admin/categoryAdmin/update.html.twig', [
                'category' => $category,
            ]);
        }

        // Si la méthode HTTP est POST (créer)

        // Mettre à jour notre categorie avec les données du
        // formulaire
        $category
            ->setName($request->request->get('name'));

        // Enregistrement du categorie en base de données
        $manager->persist($category);
        $manager->flush();

        // Redirection vers la page de liste des categories
        return $this->redirectToRoute('app_admin_categoryAdmin_retrieve');
    }

    #[Route('/admin/categories/{id}/supprimer', name: 'app_admin_categoryAdmin_delete', methods: ['GET'])]
    public function delete(
        int $id,
        CategoryRepository $repository,
        EntityManagerInterface $manager,
    ): Response {
        // Récupération d'un categorie par son id
        $category = $repository->find($id);

        // Si le categorie n'éxiste pas
        if (!$category) {
            // On affiche une page 404
            return new Response("Le categorie n'éxiste pas", 404);
        }

        // On supprime le categorie de la base de données
        $manager->remove($category);
        $manager->flush();

        // On redirige vers la liste des categories
        return $this->redirectToRoute('app_admin_categoryAdmin_retrieve');
    }
}
