<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\User;

/**
 * Cet objet contient les champs du formulaire de recherche des annonces
 */
class AdSearchCriteria
{
    /**
     * Contient le texte de recherche pour les annonces
     */
    public ?string $searchText = null;

    /**
     * Recherche des annonces par genre
     */
    public ?string $genre = null;

    /**
     * Recherche des annonces par auteut
     */
    public ?User $author = null;

    /**
     * Contient le prix minimum de la recherche
     */
    public ?float $minPrice = null;

    /**
     * Contient le prix maximum de la recherche
     */
    public ?float $maxPrice = null;

    /**
     * Contient le champ de trie
     */
    public string $orderBy = 'createdAt';

    /**
     * Contient la direction du trie
     */
    public string $direction = 'DESC';

    /**
     * Contient la limit des résultats de recherche
     */
    public int $limit = 21;

    /**
     * Contient le numéro de la page
     */
    public int $page = 1;
}
