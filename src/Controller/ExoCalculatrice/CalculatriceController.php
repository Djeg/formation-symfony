<?php

declare(strict_types=1);

namespace App\Controller\ExoCalculatrice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Contient les controlleur pour la calculatrice.
 * Cette calculatrice peut diviser, multiplier,
 * additionner et mutliplier 2 flotant.
 */
class CalculatriceController extends AbstractController
{
    #[Route('/calculatrice/additionner/{x}/{y}', name: 'app_exoCalculatrice_calculatrice_additionner')]
    public function additionner(float $x, float $y): Response
    {
        $result = $x + $y;

        return $this->render('exoCalculatrice/calculatrice/additionner.html.twig', [
            'x' => $x,
            'y' => $y,
            'result' => $result,
        ]);
    }

    #[Route('/calculatrice/soustraction/{x}/{y}', name: 'app_exoCalculatrice_calculatrice_soustraction')]
    public function soustraction(float $x, float $y): Response
    {
        $result = $x - $y;

        return $this->render('exoCalculatrice/calculatrice/soustraction.html.twig', [
            'x' => $x,
            'y' => $y,
            'result' => $result,
        ]);
    }

    #[Route('/calculatrice/division/{x}/{y}', name: 'app_exoCalculatrice_calculatrice_division')]
    public function division(float $x, float $y): Response
    {
        $result = $x / $y;

        return $this->render('exoCalculatrice/calculatrice/division.html.twig', [
            'x' => $x,
            'y' => $y,
            'result' => $result,
        ]);
    }

    #[Route('/calculatrice/multiplication/{x}/{y}', name: 'app_exoCalculatrice_calculatrice_multiplication')]
    public function multiplication(float $x, float $y): Response
    {
        $result = $x * $y;

        return $this->render('exoCalculatrice/calculatrice/multiplication.html.twig', [
            'x' => $x,
            'y' => $y,
            'result' => $result,
        ]);
    }
}
