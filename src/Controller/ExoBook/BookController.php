<?php

declare(strict_types=1);

namespace App\Controller\ExoBook;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/livres', name: 'app_exoBook_book_list')]
    public function list(BookRepository $repository): Response
    {
        // J'aimerais récupérer tout les livres de ma
        // base de données
        $books = $repository->findAll();

        return $this->render('exoBook/book/list.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/livres/nouveau', name: 'app_exoBook_book_create')]
    public function create(Request $request, BookRepository $repository): Response
    {
        // Si le formulaire à été envoyé
        if ($request->isMethod('POST')) {
            // récupération du titre du livre
            $title = $request->request->get('title');
            // Récupération du prix du livre
            $price = $request->request->get('price');

            // Création d'un livre
            $book = new Book();
            $book->setTitle($title);
            // On ajoute le prix au livre mais convertit en float !!!
            $book->setPrice((float)$price);

            // Enregistrement du livre dans la base de données :
            // (ne pas oublier de rajouter "true")
            $repository->add($book, true);

            // Redirection vers la liste des livres
            return $this->redirectToRoute('app_exoBook_book_list');
        }

        return $this->render('exoBook/book/create.html.twig');
    }
}
