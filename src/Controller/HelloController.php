<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Voici une classe de controller. Généralement un controller posséde
 * plusieurs méthode (une méthode par page) et hérite de « AbstractController ».
 * 
 * Il est souvent de bonne pratique que de créer un controller par domaine comme :
 * ArticleController (contient les pages des articles)
 * SecurityController (conitent les pages relatif à la sécurité )
 * 
 * etc ...
 */
class HelloController extends AbstractController
{
    /**
     * Ici, nous avons une première méthode : hello.
     * 
     * Le rôle de cette méthode est d'afficher une simple page
     * de bienvenue. En symfony, d'ailleurs c'est le cas de tout
     * les sites internet du monde, « une page » est réprésenté
     * par une Réponse HTTP. Ainsi notre controller se doit de
     * retourner une réponse HTTP.
     * 
     * Noté l'utilisattion de l'attribut Route ! C'est celui qui
     * permet de faire le lien entre l'URI de notre navigateur et
     * le controller. Ici, si je me rend sur la page "/hello" alors
     * c'est cette méthode qui devrait être lancé !
     * 
     * Noté aussi l'utilisation d'un « name » pour notre route. En
     * effet, Symfony utilise des routes qui sont toutes identifié
     * par un nom unique ! Généralement il est conseillé de nommé
     * nos routes ainsi : app_<nomDuController>_<nomDeLaMethod>
     * 
     * Vous pouvez aussi spécifier les méthodes HTTP accépté par se
     * controller ! Ainsi, si je demande un DELETE "/hello" et bien
     * cela n'éxécutera pas notre controller puisque ce dernier est
     * uniquement en GET et POST
     */
    #[Route('/hello', name: 'app_hello_hello', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return new Response('Coucou les amis');
    }
}
