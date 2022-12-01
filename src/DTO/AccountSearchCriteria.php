<?php

declare(strict_types=1);

namespace App\DTO;

use App\DTO\Shared\PaginationCriteria;
use App\DTO\Shared\SortCriteria;

/**
 * Contient les critéres de recherche pour les comptes
 */
class AccountSearchCriteria
{
    use PaginationCriteria;
    use SortCriteria;

    /**
     * Recherche par email
     */
    public ?string $email = null;
}
