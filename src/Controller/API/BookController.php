<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Form\API\ApiSearchBookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'app_api_book_list', methods: ['GET'])]
    public function list(BookRepository $repository, Request $request): Response
    {
        /**
         * Création d'un formulaire de recherche pour les livres :
         * ApiSearchBookType
         */
        $form = $this->createForm(ApiSearchBookType::class);

        /**
         * On remplie le formulaire avec les filtres (query string)
         * préciser dans l'url
         */
        $form->handleRequest($request);

        /**
         * On récupére les données dans la base de données,
         * on envoie le DTO (Data Transfert Object : App\DTO\BookSearch) 
         * à notre BookRepository.
         * 
         * Graçe au données contenue à l'intérieur du DTO nous pouvons
         * rechercher des livres spécifique.
         */
        $books = $repository->findBySearch($form->getData());

        /**
         * On transforme notre tableaux de livres en tableau
         * JSON et nous retournons une réponse.
         */
        return $this->json($books);
    }
}
