<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\Ingredient1Type;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/ingredient')]
class IngredientController extends AbstractController
{
    #[Route('/', name: 'admin_ingredient_index', methods: ['GET'])]
    public function index(IngredientRepository $ingredientRepository): Response
    {
        return $this->render('admin/ingredient/index.html.twig', [
            'ingredients' => $ingredientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_ingredient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(Ingredient1Type::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ingredient);
            $entityManager->flush();

            return $this->redirectToRoute('admin_ingredient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/ingredient/new.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_ingredient_show', methods: ['GET'])]
    public function show(Ingredient $ingredient): Response
    {
        return $this->render('admin/ingredient/show.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_ingredient_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ingredient $ingredient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Ingredient1Type::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_ingredient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/ingredient/edit.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_ingredient_delete', methods: ['POST'])]
    public function delete(Request $request, Ingredient $ingredient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredient->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ingredient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_ingredient_index', [], Response::HTTP_SEE_OTHER);
    }
}
