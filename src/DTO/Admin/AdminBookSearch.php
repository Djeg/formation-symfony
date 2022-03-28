<?php

declare(strict_types=1);

namespace App\DTO\Admin;

class AdminBookSearch
{
    public int $limit = 10;

    public int $page = 1;

    public string $sortBy = 'id';

    public string $direction = 'DESC';

    public ?string $title = null;

    public ?string $authorName = null;

    public ?float $maxPrice = null;

    public ?float $minPrice = null;
}
