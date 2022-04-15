<?php

declare(strict_types=1);

namespace App\DTO;

/**
 * Cette class contient tout les champs de recherche
 * disponible afin de rechercher de livres.
 */
class BookSearchCriteria implements SearchCriteria
{
	/**
	 * Contient la recherche par titre
	 * de livre
	 */
	public ?string $title = null;

	/**
	 * Contient la rechecher par nom
	 * d'auteur
	 */
	public ?string $authorName = null;

	/**
	 * Contient la rechercher par catégory
	 */
	public ?string $categoryName = null;

	/**
	 * Contient la limite des résultats
	 * par page
	 */
	public int $limit = 15;

	/**
	 * Contient la page
	 */
	public int $page = 1;

	/**
	 * Contient le champ du trie
	 */
	public string $orderBy = 'price';

	public function getLimit(): int
	{
		return $this->limit;
	}

	public function getPage(): int
	{
		return $this->page;
	}
}
