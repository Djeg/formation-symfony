<?php

declare(strict_types=1);

namespace App\DTO;

/**
 * Contient les critères de recherche pour des maisons
 * d'éditions
 */
class PublishingHouseSearchCriteria
{
    public ?string $title = null;

    public int $limit = 25;

    public int $page = 1;
}
