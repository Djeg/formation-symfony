<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller contient toutes les routes concernant
 * les livres.
 * 
 * Il sert d'éxemple pour l'utilisation du repository
 * et de l'entity doctrine.
 * 
 * Vous trouverez bien plus d'informations sur la documentation
 * officiel :
 * 
 * https://symfony.com/doc/current/doctrine.html
 */
class BookController extends AbstractController
{
    /**
     * Afin de commencer à utiliser nos données (entity et
     * repository) nous devons « injécter » (ajouter en
     * paramètre) le repository de notre choix :
     * 
     * Ici « BookRepository ». Ce dernier permet d'interargir
     * avec nos entité « Book » stocké en base de données :
     */
    #[Route('/book', name: 'app_book_index', methods: ['GET'])]
    public function index(BookRepository $repository): Response
    {
        // Récupére tout les livres :
        $books = $repository->findAll(); // Retourne une tableau de Book

        // Récupére un seul livre ou « null »
        // en utilisant son identifiant :
        $book = $repository->find(10);

        // Récupére un seul livre ou # null » en utilisant
        // le champ de notre choix, ici « title »
        $book = $repository->findOneBy(['title' => 'Harry Potter']);

        // Récupére tout les livres correspondant au critére
        // envoyé, ici tout les livres "Harry Potter"
        $books = $repository->findBy(['title' => 'Harry Potter']);

        // Créer un nouveau livre (mais ne l'enregistre pas encore dans
        // la base de données !)
        $book = new Book();
        $book
            ->setTitle('Alice au pays des merveilles')
            ->setDescription('Wonderland alice')
            ->setCreatedAt(new DateTime())
            ->setUpdatedAt(new DateTime());

        // Enregistre le nouveau livre dans la base données
        $repository->save($book, true);

        // Nous pouvons aussi modifier le livre :
        $book->setTitle('Alice Au Pays Des Merveilles');

        // Et le mettre à jour de la même manière
        $repository->save($book, true);

        // Il est aussi possible de supprimer un livre :
        $repository->remove($book, true);

        return new Response('Book');
    }
}
