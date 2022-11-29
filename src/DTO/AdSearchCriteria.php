<?php

declare(strict_types=1);

namespace App\DTO;

use App\DTO\Shared\PaginationCriteria;
use App\DTO\Shared\SearchTextCriteria;
use App\DTO\Shared\SortCriteria;
use App\Entity\User;

/**
 * Cet objet contient les champs du formulaire de recherche des annonces
 */
class AdSearchCriteria
{
    use PaginationCriteria;
    use SortCriteria;
    use SearchTextCriteria;

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
}
