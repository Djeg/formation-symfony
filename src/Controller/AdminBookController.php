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
            // @TODO : Ajouter le redirection !
            return new Response('OK');
        }

        // Je veux afficher le formulaire de création d'un livre
        return $this->render('admin_book/create.html.twig');
    }
}
