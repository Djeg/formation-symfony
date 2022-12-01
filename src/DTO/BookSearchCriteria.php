<?php

declare(strict_types=1);

namespace App\DTO;

use App\DTO\Shared\PaginationCriteria;
use App\DTO\Shared\SearchTextCriteria;
use App\DTO\Shared\SortCriteria;

/**
 * Contient les critéres de recherche pour les livres
 */
class BookSearchCriteria
{
    use PaginationCriteria;
    use SortCriteria;
    use SearchTextCriteria;

    /**
     * Contient le genre que l'on souhaite recherche
     */
    public ?string $genre = null;
}
