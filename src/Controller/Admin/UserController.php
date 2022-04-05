<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Form\UserSearchType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
}
