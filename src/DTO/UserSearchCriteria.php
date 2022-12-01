<?php

declare(strict_types=1);

namespace App\DTO;

use App\DTO\Shared\PaginationCriteria;
use App\DTO\Shared\SortCriteria;

/**
 * Contient tout les champs de recherche pour les utilisateurs
 */
class UserSearchCriteria
{
    use PaginationCriteria;
    use SortCriteria;

    /**
     * Recherche par email
     */
    public ?string $email = null;
}
