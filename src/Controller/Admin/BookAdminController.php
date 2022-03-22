<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookAdminController extends AbstractController
{
    #[Route('/admin/livres/nouveau', name: 'app_admin_bookAdmin_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(BookType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('app_admin_bookAdmin_retrieve');
        }

        $formView = $form->createView();

        return $this->render('admin/bookAdmin/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/admin/livres', name: 'app_admin_bookAdmin_retrieve', methods: ['GET'])]
    public function retrieve(BookRepository $repository): Response
    {
        // Récupérer tout les livres depuis le repository
        $books = $repository->findAll();

        // Affichage de tout les livres
        return $this->render('admin/bookAdmin/retrieve.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/admin/livres/{id}/modifier', name: 'app_admin_bookAdmin_update', methods: ['GET', 'POST'])]
    public function update(
        int $id,
        Request $request,
        BookRepository $repository,
        EntityManagerInterface $manager,
    ): Response {
        // Récupération du livre par son id
        $book = $repository->find($id);

        // Si le livre n'existe pas
        if (!$book) {
            // On retourne une page 404
            return new Response("Le livre n'éxiste pas", 404);
        }

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('app_admin_bookAdmin_retrieve');
        }

        $formView = $form->createView();

        return $this->render('admin/bookAdmin/update.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/admin/livres/{id}/supprimer', name: 'app_admin_bookAdmin_delete', methods: ['GET'])]
    public function delete(
        int $id,
        BookRepository $repository,
        EntityManagerInterface $manager,
    ): Response {
        // Récupération d'un livre par son id
        $book = $repository->find($id);

        // Si le livre n'éxiste pas
        if (!$book) {
            // On affiche une page 404
            return new Response("Le livre n'éxiste pas", 404);
        }

        // On supprime le livre de la base de données
        $manager->remove($book);
        $manager->flush();

        // On redirige vers la liste des livres
        return $this->redirectToRoute('app_admin_bookAdmin_retrieve');
    }
}
