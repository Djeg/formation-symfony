<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\DTO\AuthorSearch;
use App\Form\Admin\AdminSearchAuthorType;
use App\Form\Admin\AdminAuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
class AuthorAdminController extends AbstractController
{
    #[Route('/admin/auteurs/nouveau', name: 'app_admin_authorAdmin_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(AdminAuthorType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('app_admin_authorAdmin_retrieve');
        }

        return $this->render('admin/authorAdmin/create.html.twig', [
            'formView' => $form->createView(),
        ]);
    }

    #[Route('/admin/auteurs', name: 'app_admin_authorAdmin_retrieve', methods: ['GET'])]
    public function retrieve(AuthorRepository $repository, Request $request): Response
    {
        $form = $this->createForm(AdminSearchAuthorType::class, new AuthorSearch());

        $form->handleRequest($request);

        $authors = $repository->findBySearch($form->getData());

        // Affichage de tout les auteurs
        return $this->render('admin/authorAdmin/retrieve.html.twig', [
            'authors' => $authors,
            'formView' => $form->createView(),
        ]);
    }

    #[Route('/admin/auteurs/{id}/modifier', name: 'app_admin_authorAdmin_update', methods: ['GET', 'POST'])]
    public function update(
        int $id,
        Request $request,
        AuthorRepository $repository,
        EntityManagerInterface $manager,
    ): Response {
        // Récupération du auteur par son id
        $author = $repository->find($id);

        // Si le auteur n'existe pas
        if (!$author) {
            // On retourne une page 404
            return new Response("Le auteur n'éxiste pas", 404);
        }

        $form = $this->createForm(AdminAuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('app_admin_authorAdmin_retrieve');
        }

        return $this->render('admin/authorAdmin/update.html.twig', [
            'formView' => $form->createView(),
        ]);
    }

    #[Route('/admin/auteurs/{id}/supprimer', name: 'app_admin_authorAdmin_delete', methods: ['GET'])]
    public function delete(
        int $id,
        AuthorRepository $repository,
        EntityManagerInterface $manager,
    ): Response {
        // Récupération d'un auteur par son id
        $author = $repository->find($id);

        // Si le auteur n'éxiste pas
        if (!$author) {
            // On affiche une page 404
            return new Response("L'auteur n'éxiste pas", 404);
        }

        // On supprime le auteur de la base de données
        $manager->remove($author);
        $manager->flush();

        // On redirige vers la liste des auteurs
        return $this->redirectToRoute('app_admin_authorAdmin_retrieve');
    }
}
