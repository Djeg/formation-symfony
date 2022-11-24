<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller contient toutes les pages d'administration d'un
 * utilisateur
 */
#[IsGranted('ROLE_ADMIN')]
class AdminUserController extends AbstractController
{
    /**
     * Créer un nouvel utilisateur
     */
    #[Route('/admin/utilisateurs/nouveau', name: 'app_adminUser_create', methods: ['GET', 'POST'])]
    public function create(Request $request, UserRepository $repository): Response
    {
        // Créer le formulaire d'un utilisateur
        $form = $this->createForm(UserType::class);

        // Remplir le formulaire
        $form->handleRequest($request);

        // On test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Si valide, on récupére l'utilisateur
            $user = $form->getData();

            // Si valide, on met les dates de création et d'édition dans l'utilisateur
            $user
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime());

            // Si valide, on enregistre l'utilisateur dans la base
            $repository->save($user, true);

            // Si valide, on redirige sur la liste
            return $this->redirectToRoute('app_adminUser_list');
        }

        // Sinon, on affiche la page de création avec le formulaire
        return $this->render('adminUser/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Liste les utilisateurs
     */
    #[Route('/admin/utilisateurs', name: 'app_adminUser_list', methods: ['GET'])]
    public function list(UserRepository $repository): Response
    {
        // Récupérer tout les utilisateurs
        $users = $repository->findAll();

        // Afficher la page des utilisateurs
        return $this->render('adminUser/list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * Édite un utilisateur
     */
    #[Route('/admin/utilisateurs/{id}', name: 'app_adminUser_update', methods: ['GET', 'POST'])]
    public function update(User $user, Request $request, UserRepository $repository): Response
    {
        // Créer le formulaire d'un utilisateur
        $form = $this->createForm(UserType::class, $user);

        // Remplir le formulaire
        $form->handleRequest($request);

        // On test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Si valide, on met les dates de création et d'édition dans l'utilisateur
            $user->setUpdatedAt(new DateTime());

            // Si valide, on enregistre l'utilisateur dans la base
            $repository->save($user, true);

            // Si valide, on redirige sur la liste
            return $this->redirectToRoute('app_adminUser_list');
        }

        // Sinon, on affiche la page de création avec le formulaire
        return $this->render('adminUser/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime un utilisateur
     */
    #[Route('/admin/utilisateurs/{id}/supprimer', name: 'app_adminUser_remove', methods: ['GET'])]
    public function remove(User $user, UserRepository $repository): Response
    {
        // on supprimer l'utilisateur
        $repository->remove($user, true);

        // on redirige vers la liste
        return $this->redirectToRoute('app_adminUser_list');
    }
}
