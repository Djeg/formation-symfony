<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Pizza;
use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Contient toutes les routes d'administration des pizzas
 * pour l'application PizzaShop
 */
#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/pizzas')]
class PizzaController extends AbstractController
{
    /**
     * Récupére et listes toutes les pizzas disponible
     * dans l'appllication
     */
    #[Route('/', name: 'app_admin_pizza_retrieve')]
    public function retrieve(PizzaRepository $repository): Response
    {
        $pizzas = $repository->findLatest();

        return $this->render('admin/pizza/retrieve.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }

    /**
     * Permet de créer une nouvelle pizza
     */
    #[Route('/nouvelle', name: 'app_admin_pizza_create')]
    public function create(Request $request, PizzaRepository $repository): Response
    {
        $form = $this->createForm(PizzaType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->add($form->getData());

            return $this->redirectToRoute('app_admin_pizza_retrieve');
        }

        return $this->render('admin/pizza/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet de mettre à jour une pizza
     */
    #[Route('/{id}/modifier', name: 'app_admin_pizza_update')]
    public function update(
        Pizza $pizza,
        Request $request,
        PizzaRepository $repository,
    ): Response {
        $form = $this->createForm(PizzaType::class, $pizza);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->add($form->getData());

            return $this->redirectToRoute('app_admin_pizza_retrieve');
        }

        return $this->render('admin/pizza/update.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet de supprimer une pizza
     */
    #[Route('/{id}/supprimer', name: 'app_admin_pizza_delete')]
    public function delete(Pizza $pizza, PizzaRepository $repository): Response
    {
        $repository->remove($pizza);

        return $this->redirectToRoute('app_admin_pizza_retrieve');
    }
}
