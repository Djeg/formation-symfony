<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    #[Route('/pizza', name: 'app_pizza')]
    public function index(): Response
    {
        return $this->render('pizza/index.html.twig', [
            'controller_name' => 'PizzaController',
        ]);
    }

    #[Route('/pizza/nouvelle', name: 'app_pizza_newPizza')]
    public function newPizza(Request $request, PizzaRepository $repository): Response
    {
        // Si le formulaire est envoyé
        if ($request->isMethod('POST')) {
            // Récupération des champs du formulaire
            $name = $request->request->get('name');
            $price = $request->request->get('price');
            $description = $request->request->get('description');
            $imageUrl = $request->request->get('imageUrl');

            // Créer une pizza et la remplir avec les données
            // du formulaire
            $pizza = new Pizza();
            $pizza->setName($name);
            $pizza->setDescription($description);
            $pizza->setPrice((float)$price);
            $pizza->setImageUrl($imageUrl);

            // enregistrer la pizza en base de données
            $repository->add($pizza, true);

            // redirection sur la liste des pizzas
            return $this->redirectToRoute('app_pizza');
        }

        return $this->render('pizza/newPizza.html.twig');
    }
}
