<?php

declare(strict_types=1);

namespace App\DTO;

class BookAdCriteria
{
    public int $limit = 25;

    public int $page = 1;

    public ?string $title = null;

    public string $orderBy = 'createdAt';

    public string $direction = 'DESC';

    public ?array $states = null;

    public ?int $minPrice = null;

    public ?int $maxPrice = null;

    public ?string $user = null;
}
