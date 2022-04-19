<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_frontend_home_home', methods: ['GET'])]
    public function home(PizzaRepository $repository): Response
    {
        $pizzas = $repository->findAll();

        return $this->render('frontend/home/home.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }
}
