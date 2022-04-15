<?php

declare(strict_types=1);

namespace App\DTO;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Contient tout les champs de recherche pour un auteur
 */
class AuthorSearchCriteria implements SearchCriteria
{
	/**
	 * Contient la recherche par nom
	 */
	public ?string $name = null;

	/**
	 * Contient la limite des résultats
	 */
	#[Assert\Positive(message: 'La limite doit être positive')]
	public int $limit = 15;

	/**
	 * Contient la page des résultats
	 */
	public int $page = 1;

	/**
	 * Contient le champ de trie
	 */
	public string $orderBy = 'id';

	/**
	 * Contient la direction du trie
	 */
	public string $direction = 'DESC';

	/**
	 * Contient la date de départ 
	 */
	public ?DateTime $updatedAtStart = null;

	/**
	 * Contient la date de fin
	 */
	public ?DateTime $updatedAtStop = null;

	public function getLimit(): int
	{
		return $this->limit;
	}

	public function getPage(): int
	{
		return $this->page;
	}
}
