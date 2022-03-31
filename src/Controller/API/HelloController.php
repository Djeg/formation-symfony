<?php

declare(strict_types=1);

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/api/hello', name: 'api_hello_hello', methods: ['GET'])]
    public function hello(): Response
    {
        return $this->json([
            'message' => 'Bonjour de notre api :)',
        ]);
    }
}
