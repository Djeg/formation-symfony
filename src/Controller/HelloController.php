<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello_hello', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        /**
         * Un Response est un objet PHP symbolisant la Response HTTP.
         * 
         * Vous retrouverez si dessous les instructions principal
         * de cette objet. Cependant vous pouvez en apprendre bien
         * plus :
         * 
         * https://symfony.com/doc/current/components/http_foundation.html#response
         */

        // Création d'une réponse
        $response = new Response('Coucou les amis');

        // Création d'une réponse avec un contenu et un status code !
        $response = new Response('Coucou les amis', Response::HTTP_CREATED);

        // Changement du status code et text :
        $response->setStatusCode(Response::HTTP_OK);

        // Ajout d'un header HTTP si ce dernier n'est pas dèja présent
        if (!$response->headers->has('W-Powered-By')) {
            $response->headers->set('X-Powered-By', 'Super Symfony !');
        }

        // Changement du contenu de la réponse
        $response->setContent('Youhouuuu !');

        return $response;
    }
}
