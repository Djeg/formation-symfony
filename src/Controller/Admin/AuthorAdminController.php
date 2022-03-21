<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorAdminController extends AbstractController
{
    #[Route('/admin/auteurs/nouveau', name: 'app_admin_authorAdmin_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        // si la méthode HTTP est GET (obtenir)
        if ($request->isMethod('GET')) {
            // Affichage de la page de création d'un auteur
            return $this->render('admin/authorAdmin/create.html.twig');
        }

        // si la méthode HTTP est POST (créer)

        // Création du nouveau auteur
        $author = (new Author())
            ->setName($request->request->get('name'))
            ->setDescription($request->request->get('description'))
            ->setPictures($request->request->get('pictures'));

        // Enregistrement, persistence du nouveau auteur
        $manager->persist($author);
        $manager->flush();

        // Redirection vers la page de la liste des auteurs
        return $this->redirectToRoute('app_admin_authorAdmin_retrieve');
    }

    #[Route('/admin/auteurs', name: 'app_admin_authorAdmin_retrieve', methods: ['GET'])]
    public function retrieve(AuthorRepository $repository): Response
    {
        // Récupérer tout les auteurs depuis le repository
        $authors = $repository->findAll();

        // Affichage de tout les auteurs
        return $this->render('admin/authorAdmin/retrieve.html.twig', [
            'authors' => $authors,
        ]);
    }

    #[Route('/admin/auteurs/{id}/modifier', name: 'app_admin_authorAdmin_update', methods: ['GET', 'POST'])]
    public function update(
        int $id,
        Request $request,
        AuthorRepository $repository,
        EntityManagerInterface $manager,
    ): Response {
        // Récupération du auteur par son id
        $author = $repository->find($id);

        // Si le auteur n'existe pas
        if (!$author) {
            // On retourne une page 404
            return new Response("Le auteur n'éxiste pas", 404);
        }

        // Si la méthode HTTP est GET (obtenir)
        if ($request->isMethod('GET')) {
            // Affichage du formulaire de mise à jour du auteur
            return $this->render('admin/authorAdmin/update.html.twig', [
                'author' => $author,
            ]);
        }

        // Si la méthode HTTP est POST (créer)

        // Mettre à jour notre auteur avec les données du
        // formulaire
        $author
            ->setName($request->request->get('name'))
            ->setDescription($request->request->get('description'))
            ->setPictures($request->request->get('pictures'));

        // Enregistrement du auteur en base de données
        $manager->persist($author);
        $manager->flush();

        // Redirection vers la page de liste des auteurs
        return $this->redirectToRoute('app_admin_authorAdmin_retrieve');
    }

    #[Route('/admin/auteurs/{id}/supprimer', name: 'app_admin_authorAdmin_delete', methods: ['GET'])]
    public function delete(
        int $id,
        AuthorRepository $repository,
        EntityManagerInterface $manager,
    ): Response {
        // Récupération d'un auteur par son id
        $author = $repository->find($id);

        // Si le auteur n'éxiste pas
        if (!$author) {
            // On affiche une page 404
            return new Response("L'auteur n'éxiste pas", 404);
        }

        // On supprime le auteur de la base de données
        $manager->remove($author);
        $manager->flush();

        // On redirige vers la liste des auteurs
        return $this->redirectToRoute('app_admin_authorAdmin_retrieve');
    }
}
