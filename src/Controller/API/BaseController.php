<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\DTO\SearchCriteria;
use App\Repository\SearchableRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
	public function listEntities(
		string $formType,
		SearchCriteria $data,
		SearchableRepository $repository,
	): Response {
		$form = $this->createForm($formType, $data);

		$form->handleRequest($this->container->get('request_stack')->getCurrentRequest());

		$criterias = $form->isSubmitted() && $form->isValid()
			? $form->getData()
			: $data;

		$books = $repository->findByCriteria($criterias);

		return $this->json($books);
	}
}
