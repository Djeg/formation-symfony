<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\User;
use DateTime;

/**
 * Cette classe contient les données du formulaire de recherche
 * des annonces
 */
class AdSearchCriteria
{
    /**
     * Contient le texte de recherche
     */
    public ?string $searchText = null;

    /**
     * Contient la recherche par genre
     */
    public ?string $genre = null;

    /**
     * Contient la recherche par auteur
     */
    public ?User $author = null;

    /**
     * Contient la recherche par prix minimum
     */
    public ?float $minPrice = null;

    /**
     * Contient la recherche par prix minimum
     */
    public ?float $maxPrice = null;

    /**
     * Contient la date de départ de la recherche
     */
    public ?DateTime $startedAt = null;

    /**
     * Contient la date de départ de la recherche
     */
    public ?DateTime $endedAt = null;

    /**
     * Contient la champs du trie
     */
    public string $orderBy = 'createdAt';

    /**
     * Contient la direction du trie
     */
    public string $direction = 'DESC';

    /**
     * Contient la limite des résultats
     */
    public int $limit = 21;

    /**
     * Contient la page voulue
     */
    public int $page = 1;
}
