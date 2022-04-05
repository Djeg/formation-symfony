<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserSearchType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controlleur contient toutes les pages de l'administration
 * relatives aux utilisateurs
 */
#[Route('/admin/users')]
#[IsGranted('ROLE_ADMIN')]
class UserController extends AbstractController
{
    /**
     * Cette route affiche la liste de tout les utilisateurs
     * de l'application
     */
    #[Route('/', name: 'app_admin_user_retrieve')]
    public function retrieve(UserRepository $repository, Request $request): Response
    {
        $form = $this->createForm(UserSearchType::class);

        $form->handleRequest($request);

        $users = $repository->findBySearch($form->getData());

        return $this->render('admin/user/retrieve.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Cette route permet de créer un nouvel utilisateur
     * dans la base de données
     */
    #[Route('/nouveau', name: 'app_admin_user_create')]
    public function create(
        Request $request,
        UserRepository $repository,
        UserPasswordHasherInterface $hasher,
    ): Response {
        $form = $this->createForm(UserType::class, new User(), [
            'admin' => true,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $user->setPassword($hasher->hashPassword(
                $user,
                $user->getPassword(),
            ));

            $repository->add($user);

            return $this->redirectToRoute('app_admin_user_retrieve');
        }

        return $this->render('admin/user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Cette route permet de modifier un utilisateur
     * dans la base de données
     */
    #[Route('/{id}/modifier', name: 'app_admin_user_update')]
    public function update(
        User $user,
        Request $request,
        UserRepository $repository,
        UserPasswordHasherInterface $hasher,
    ): Response {
        $form = $this->createForm(UserType::class, $user, [
            'admin' => true,
            'mode' => 'update',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('password')->getData()) {
                $user->setPassword($hasher->hashPassword(
                    $user,
                    $user->getPassword(),
                ));
            }

            $repository->add($user);

            return $this->redirectToRoute('app_admin_user_retrieve');
        }

        return $this->render('admin/user/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Cette route permet de supprimer un utilisateur
     * de la base de données
     */
    #[Route('/{id}/supprimer', name: 'app_admin_user_delete')]
    public function delete(
        User $user,
        UserRepository $repository,
    ): Response {
        $repository->remove($user);

        return $this->redirectToRoute('app_admin_user_retrieve');
    }
}
