<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatriceController
{
    #[Route('/additionner/{x}/{y}', name: 'app_calculatrice_additionner')]
    public function additionner(Request $request, float $x, float $y): Response
    {
        $precision = (int)$request->query->get('precision');
        $resultat = round($x + $y, $precision);

        return new Response("$x + $y = $resultat");
    }

    #[Route('/soustraire/{x}/{y}', name: 'app_calculatrice_soustraire')]
    public function soustraire(Request $request, float $x, float $y): Response
    {
        $precision = (int)$request->query->get('precision');
        $resultat = round($x - $y, $precision);

        return new Response("$x - $y = $resultat");
    }

    #[Route('/multiplier/{x}/{y}', name: 'app_calculatrice_multiplier')]
    public function multiplier(Request $request, float $x, float $y): Response
    {
        $precision = (int)$request->query->get('precision');
        $resultat = round($x * $y, $precision);

        return new Response("$x * $y = $resultat");
    }

    #[Route('/diviser/{x}/{y}', name: 'app_calculatrice_diviser')]
    public function diviser(Request $request, float $x, float $y): Response
    {
        $precision = (int)$request->query->get('precision');
        $resultat = round($x / $y, $precision);

        return new Response("$x / $y = $resultat");
    }

    #[Route('/calcule/{x}/{y}', name: 'app_calculatrice_calcule')]
    public function calcule(Request $request, float $x, float $y): Response
    {
        $operation = $request->headers->get('operation');

        if ($operation === "additionner") {
            return $this->additionner($request, $x, $y);
        }

        if ($operation === "multiplier") {
            return $this->multiplier($request, $x, $y);
        }

        if ($operation === "soustraire") {
            return $this->soustraire($request, $x, $y);
        }

        if ($operation === "diviser") {
            return $this->diviser($request, $x, $y);
        }

        return new Response("Oops je connais pas l'operation", 400);

        /* switch ($operation) {
            case "additionner":
                return $this->additionner($x, $y);
            case "multiplier":
                return $this->multiplier($x, $y);
            case "diviser":
                return $this->diviser($x, $y);
            case "soustraire":
                return $this->soustraire($x, $y);
            default:
                return new Response("Oops je connais pas l'operation", 400);
        }*/
    }
}
