<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/livres/{id}', name: 'app_home_book')]
    public function book(int $id): Response
    {
        return new Response("Vous avez demandé le livre n°$id");
    }

    #[Route('/nous-contacter', name: 'app_home_contact')]
    public function contact(Request $request): Response
    {
        $method = $request->getMethod();

        return new Response("La méthode http est $method");
    }
}
