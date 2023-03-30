<?php

declare(strict_types=1);

namespace App\DTO;

use DateTime;

/**
 * Contient les critères de recherche concernant les livres de
 * l'application
 */
class BookSearchCriteria
{
    public ?string $title = null;

    public ?string $author = null;

    public ?string $publishingHouse = null;

    public int $limit = 25;

    public int $page = 1;

    public ?DateTime $startAt = null;

    public ?DateTime $endAt = null;
}
