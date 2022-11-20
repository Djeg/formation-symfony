<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * Afin d'utiliser l'objet Symfony Request (représentant la Request HTTP)
     * il faut tout d'abord l'injécter (l'envoyer en paramètre de notre
     * controller)
     */
    #[Route('/hello', name: 'app_hello_hello', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        /**
         * Grâce à l'bjet Request injécté plus haut, symfony met à disposition
         * toutes les informations relatives à la Request HTTP !
         * 
         * Vous trouverez ci dessous les cas d'utilisation les plus répandu,
         * cependant rien ne vaut la documentation officiel :
         * 
         * https://symfony.com/doc/current/components/http_foundation.html#request
         */

        // Récupération et test de la méthod HTTP 
        $request->isMethod(Request::METHOD_GET);
        $method = $request->getMethod();

        // Récupération des « Queries » de l'url (les filtres)
        if ($request->query->has('id')) {
            $request->query->get('id');
        }

        // Récupération des données de formulaire
        if ($request->request->has('email') && $request->request->has('password')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
        }

        // récupération des cookies
        $request->cookies->has('userId');
        $request->cookies->get('userId');

        return new Response('hello');
    }
}
