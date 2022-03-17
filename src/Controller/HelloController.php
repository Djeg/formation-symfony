<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/{nom}', name: 'app_hello_hello', methods: ['GET'])]
    public function hello(Request $request, string $nom): Response
    {
        // Création d'un objet Response correspondant
        // au fichier text de la réponse
        $response = new Response("Hello $nom :)");

        // Changement du status code de la response
        $response->setStatusCode(200);

        // Affiche la méthode HTTP que le client utilisé
        $request->getMethod(); // GET

        // Récupére l'url compléte rentré par l'utilisateur
        $request->getUri();

        // Récupére un en tête http
        $request->headers->get('User-Agent');

        // Récupére un filtre (une query string)
        $request->query->get('taille');

        // Récupére un cookie
        $request->cookies->get('Nom du cookie');

        return $this->render('hello/hello.html.twig', [
            'nom' => $nom,
        ]);
    }

    #[Route('/bonjour/{nom}', name: 'app_hello_bonjour')]
    public function bonjour(string $nom): Response
    {
        return new Response("Bonjour $nom, comment allez-vous ?");
    }
}
