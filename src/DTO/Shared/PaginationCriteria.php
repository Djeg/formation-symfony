<?php

declare(strict_types=1);

namespace App\DTO\Shared;

/**
 * Contient les critéres de recherche d'une pagination
 */
trait PaginationCriteria
{
    /**
     * Contient la limit des résultats de recherche
     */
    public int $limit = 21;

    /**
     * Contient le numéro de la page
     */
    public int $page = 1;
}
