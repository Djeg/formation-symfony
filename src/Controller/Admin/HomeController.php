<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Voici la class de controlleur affichane la page
 * d'accueil de l'administration
 */
#[IsGranted('ROLE_ADMIN')]
class HomeController extends AbstractController
{
    /**
     * Affiche la page d'accueil de l'administration
     */
    #[Route('/admin', name: 'app_admin_home_home')]
    public function home(): Response
    {
        return $this->render('admin/home/home.html.twig');
    }
}
