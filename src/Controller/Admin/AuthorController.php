<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{
	#[Route('/admin/auteurs', name: 'app_admin_author_list', methods: ['GET'])]
	public function list(): Response
	{
		return new Response('test');
	}
}
