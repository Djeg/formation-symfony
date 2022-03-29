<?php

declare(strict_types=1);

namespace App\DTO;

class BookSearch
{
    public int $limit = 10;

    public int $page = 1;

    public string $sortBy = 'id';

    public string $direction = 'DESC';

    public ?string $title = null;

    public ?string $authorName = null;

    public ?string $categoryName = null;

    public ?int $authorId = null;

    public ?float $maxPrice = null;

    public ?float $minPrice = null;
}
