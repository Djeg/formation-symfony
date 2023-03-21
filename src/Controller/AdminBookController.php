<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller permettant de gérer les livres de notre application. Nous
 * retrouvons 4 routes, la création d'un livre, la mise à jour, la suppression
 * et la liste des livres.
 */
class AdminBookController extends AbstractController
{
    /**
     * Méthode permettant de créer un nouveau livre
     */
    #[Route('/admin/livres/nouveau', name: 'app_admin_book_create')]
    public function create(Request $request, BookRepository $repository): Response
    {
        // je veux tester si le formulaire a était envoyé
        if ($request->isMethod(Request::METHOD_POST)) {
            // je veux récupérer les données envoyé dans le formulaire
            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $genre = $request->request->get('genre');

            // je veux créer un livre
            $book = new Book();
            $book->setTitle($title);
            $book->setDescription($description);
            $book->setGenre($genre);
            // https://www.php.net/manual/fr/class.datetime
            // $today = new DateTime();
            // $today->format('d/m/Y H:i');
            // $hier = DateTime::createFromFormat('d/m/Y H:i:s', '20/03/2023 12:54:08')
            $book->setCreatedAt(new DateTime());
            $book->setUpdatedAt(new DateTime());

            // je veux enregistrer un livre dans la base de données
            $repository->save($book, true);

            // je veux rediriger vers la liste des livres
            return $this->redirectToRoute('app_admin_book_list');
        }

        // Je veux afficher le formulaire de création d'un livre
        return $this->render('admin_book/create.html.twig');
    }

    /**
     * Liste tout les livres de l'application
     */
    #[Route('/admin/livres', name: 'app_admin_book_list')]
    public function list(BookRepository $repository): Response
    {
        // Je récupére tout les livres de ma base de données
        $books = $repository->findAll();

        // J'affiche la liste des livres
        return $this->render('admin_book/list.html.twig', [
            // On envoie à twig, tout nos livres
            'books' => $books,
        ]);
    }

    /**
     * Modifie un livre de la base de données
     */
    #[Route('/admin/livres/{id}', name: 'app_admin_book_update')]
    public function update(Book $book, Request $request, BookRepository $repository): Response
    {
        // Je teste si le formulaire à bien été envoyé
        if ($request->isMethod(Request::METHOD_POST)) {
            // Je récupére les champs envoyé par l'utilisateur
            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $genre = $request->request->get('genre');

            // Je modifie les données du livre
            $book
                ->setTitle($title)
                ->setDescription($description)
                ->setGenre($genre)
                ->setUpdatedAt(new DateTime());

            // Je sauvegarde le livre dans la base de données
            $repository->save($book, true);

            // Je redirige vers la liste des livres
            return $this->redirectToRoute('app_admin_book_list');
        }

        // J'affiche le formulaire de modification d'un livre
        return $this->render('admin_book/update.html.twig', [
            'book' => $book,
        ]);
    }
}
