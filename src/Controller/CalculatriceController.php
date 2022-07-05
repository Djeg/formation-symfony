<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/calculatrice')]
class CalculatriceController extends AbstractController
{
    #[Route('/accueil', name: 'app_calculatrice_index')]
    public function index(Request $request): Response
    {
        // Si la requête est post
        if ($request->isMethod('POST')) {
            // on récupére l'opération ainsi que x et y
            $operation = $request->request->get('operation');
            $y = $request->request->get('y');
            $x = $request->request->get('x');

            // Si l'opération est addition
            if ('addition' === $operation) {
                // Rediriger vers la page d'addition
                return $this->redirectToRoute('app_calculatrice_additionner', [
                    // Ici nous devons spécifier les 2 paramètres de la route
                    // « additionner ».
                    'x' => $x,
                    'y' => $y,
                ]);
            }

            // Si l'operation est soustraction
            if ('soustraction' === $operation) {
                // Rediriger vers la page de soustraction
                return $this->redirectToRoute('app_calculatrice_soustraire', [
                    'x' => $x,
                    'y' => $y,
                ]);
            }

            // Si l'operation est multiplication
            if ('multiplication' === $operation) {
                // Rediriger vers la page de multiplication
                return $this->redirectToRoute('app_calculatrice_multiplier', [
                    'x' => $x,
                    'y' => $y,
                ]);
            }

            // Si l'operation est division
            if ('division' === $operation) {
                // Rediriger vers la page de division
                return $this->redirectToRoute('app_calculatrice_diviser', [
                    'x' => $x,
                    'y' => $y,
                ]);
            }
        }

        return $this->render('calculatrice/index.html.twig');
    }

    #[Route('/additionner/{x}/{y}', name: 'app_calculatrice_additionner')]
    public function additionner(int $x, int $y): Response
    {
        $total = $x + $y;

        return $this->render('calculatrice/additionner.html.twig', [
            'firstNumber' => $x,
            'secondNumber' => $y,
            'total' => $total,
        ]);
    }

    #[Route('/soustraire/{x}/{y}', name: 'app_calculatrice_soustraire')]
    public function soustraire(int $x, int $y): Response
    {
        $total = $x - $y;

        return $this->render('calculatrice/soustraire.html.twig', [
            'x' => $x,
            'y' => $y,
            'total' => $total,
        ]);
    }

    #[Route('/multiplier/{x}/{y}', name: 'app_calculatrice_multiplier')]
    public function multiplier(int $x, int $y): Response
    {
        $total = $x * $y;

        return $this->render('calculatrice/multiplier.html.twig', [
            'x' => $x,
            'y' => $y,
            'total' => $total,
        ]);
    }

    #[Route('/diviser/{x}/{y}', name: 'app_calculatrice_diviser')]
    public function diviser(int $x, int $y): Response
    {
        $error = '';

        if ($y === 0) {
            $error = 'Division par 0 impossible';

            $response = new Response('', 400);

            return $this->render('calculatrice/diviser.html.twig', [
                'x' => $x,
                'y' => $y,
                'total' => 0,
                'error' => $error,
            ], $response);
        }

        $total = $x / $y;

        return $this->render('calculatrice/diviser.html.twig', [
            'x' => $x,
            'y' => $y,
            'total' => $total,
            'error' => $error,
        ]);
    }
}
