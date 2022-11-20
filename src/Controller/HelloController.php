<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * Création d'une route avec un paramètre.
     * 
     * Les paramètres de routes sont très utile ! Ils permettent 
     * de rendre dynamique une partie d'une URI. Ici, essayer de vous rendre suir la page  "/hello/jean" !
     * 
     * Pour utiliser un paramètre de route il faut tout d'abord le déclarer
     * dans l'URI de la route (ici "/hello/{name}"). Un paramètre posséde
     * un nom et c'est ce dernier qui est utilisé afin de le récupérer !
     */
    #[Route('/hello/{name}', name: 'app_hello_someone', methods: ['GET', 'POST'])]
    public function someone(string $name): Response
    {
        /**
         * Ici le paramétre de controller $name provient de la route !
         * 
         * Symfony est assez inteligent pour faire le lien entre
         * la string $name et le paramètre de la route {name} puisque
         * ces derniers sont nommés à l'identique !
         */
        return new Response('Bonjour ' . $name);
    }
}
