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
    public function index(PizzaRepository $repository): Response
    {
        // récupération de toutes les pizzas
        $pizzas = $repository->findAll();

        // Afficher dans un fichier html les pizzas
        return $this->render('pizza/index.html.twig', [
            'pizzas' => $pizzas,
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

    #[Route('/pizza/{id}/modifier', name: 'app_pizza_update')]
    public function update(int $id, PizzaRepository $repository, Request $request): Response
    {
        // J'aimerais récupérer la pizza avec l'id reçu plus haut
        $pizza = $repository->find($id);

        // Si le formulaire a été envoyé
        if ($request->isMethod('POST')) {
            // Récupération des données du formulaire
            $name = $request->request->get('name');
            $price = $request->request->get('price');
            $description = $request->request->get('description');
            $imageUrl = $request->request->get('imageUrl');

            // Modification de la pizza avec les données du formulaire
            $pizza->setName($name);
            $pizza->setDescription($description);
            $pizza->setPrice((float)$price);
            $pizza->setImageUrl($imageUrl);

            // Utiliser le repository afin d'enregistrer la pizza en base de données
            $repository->add($pizza, true);

            // Si tout c'est bien passé, on redirige vers la liste des pizzas
            return $this->redirectToRoute('app_pizza');
        }

        // Afiicher le formulaire d'édition de la pizza
        return $this->render('pizza/update.html.twig', [
            'pizza' => $pizza,
        ]);
    }

    #[Route('/pizza/{id}/supprimer', name: 'app_pizza_remove')]
    public function remove(int $id, PizzaRepository $repository): Response
    {
        // Je récupére la pizza depuis la base de données
        $pizza = $repository->find($id);

        // Je supprime la pizza
        $repository->remove($pizza, true);

        // Je redirige vers la liste des pizzas
        return $this->redirectToRoute('app_pizza');
    }
}
