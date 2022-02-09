<?php

namespace App\Controller\Admin;

use App\DTO\SearchDishCriteria;
use App\Entity\Dish;
use App\Form\DishType;
use App\Form\SearchDishType;
use App\Repository\DishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/dish')]
class DishController extends AbstractController
{
    #[Route('/', name: 'admin_dish_index', methods: ['GET'])]
    public function index(DishRepository $dishRepository, Request $request): Response
    {
        // 1. Création du DTO
        $criteria = new SearchDishCriteria();
        // 2. Création du formulaire
        $form = $this->createForm(SearchDishType::class, $criteria);

        // 3. On remplie le DTO avec ce que l'utilisateur à spécifié
        $form->handleRequest($request);

        return $this->render('admin/dish/index.html.twig', [
            'dishes' => $dishRepository->findAllByCriteria($criteria),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'admin_dish_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dish = new Dish();
        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dish);
            $entityManager->flush();

            return $this->redirectToRoute('admin_dish_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/dish/new.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_dish_show', methods: ['GET'])]
    public function show(Dish $dish): Response
    {
        return $this->render('admin/dish/show.html.twig', [
            'dish' => $dish,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_dish_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dish $dish, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_dish_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/dish/edit.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_dish_delete', methods: ['POST'])]
    public function delete(Request $request, Dish $dish, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $dish->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dish);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_dish_index', [], Response::HTTP_SEE_OTHER);
    }
}
