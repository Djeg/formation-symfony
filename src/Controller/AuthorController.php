<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/auteurs/nouveau', name: 'app_author_create')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        if ($request->isMethod('GET')) {
            return $this->render('author/create.html.twig');
        }

        $author = new Author();
        $name = $request->request->get('name');
        $description = $request->request->get('description');
        $image = $request->request->get('image');

        $author->setName($name);
        $author->setDescription($description);
        $author->setImage($image);

        $manager->persist($author);

        $manager->flush();

        return $this->redirectToRoute('app_author_list');
    }

    #[Route('/auteurs', name: 'app_author_list')]
    public function list(AuthorRepository $repository): Response
    {
        $authors = $repository->findAll();

        return $this->render('author/list.html.twig', [
            'authors' => $authors,
        ]);
    }

    #[Route('/auteurs/{id}/modifier', name: 'app_author_update')]
    public function update(Request $request, EntityManagerInterface $manager, AuthorRepository $repository, int $id): Response
    {
        // Récupération d'un auteur par son id
        $author = $repository->find($id);

        // On test si le auteur éxiste
        if (!$author) {
            // retour d'une réponse 404
            return new Response("Le auteur n'éxiste pas", 404);
        }

        if ($request->isMethod('GET')) {
            return $this->render('author/update.html.twig', ['author' => $author]);
        }

        $author->setName($request->request->get('name'));
        $author->setDescription($request->request->get('description'));
        $author->setImage($request->request->get('image'));

        $manager->persist($author);
        $manager->flush();

        return $this->redirectToRoute('app_author_list');
    }

    #[Route('/auteurs/{id}/supprimer', name: 'app_author_remove')]
    public function remove(
        AuthorRepository $repository,
        EntityManagerInterface $manager,
        int $id,
    ): Response {
        // Récupération d'un auteur
        $author = $repository->find($id);

        // On test si le auteur éxiste
        if (!$author) {
            // retour d'une réponse 404
            return new Response("Le auteur n'éxiste pas", 404);
        }

        $manager->remove($author);
        $manager->flush();

        return $this->redirectToRoute('app_author_list');
    }
}
