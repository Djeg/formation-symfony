<?php

namespace App\Controller;

use DateTime;
use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Ce controller contient le code de la page d'accueil
 */
class HomeController extends AbstractController
{
    /**
     * Affiche la page d'accueil
     */
    #[Route('/', name: 'app_home_index', methods: ['GET'])]
    public function index(BookRepository $repository): Response
    {
        // J'ai envie de récuperer tout les livres de ma base de données
        $books = $repository->findAll();

        // J'ai envie de récupérer le livre avec l'id 10
        $book = $repository->find(10);

        // J'ai enve de récuperer le livre avec le titre "Harry Potter"
        $book = $repository->findOneBy([
            'title' => 'Harry Potter',
        ]);

        // Je souhaiterais de récupérer les 10 derniers livres
        $books = $repository->findBy([], ['createdAt', 'DESC'], 10);

        // Je souhaiterais créer un nouveau livre
        $book = (new Book())
            ->setTitle('Super book')
            ->setDescription('super description')
            ->setGenre('Science-Fiction')
            ->setCreatedAt(new DateTime())
            ->setUpdatedAt(new DateTime());

        // Enregistrement du livre dans la base
        $repository->save($book, true);

        // Mettre à jour un livre avec la même commande :
        $book->setTitle('Nouveau titre');

        $repository->save($book, true);

        // Supprime un libre
        $repository->remove($book, true);

        return new Response("Page d'accueil");
    }
}
