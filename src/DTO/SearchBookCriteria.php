<?php

declare(strict_types=1);

namespace App\DTO;

class SearchBookCriteria
{
    public ?string $title = '';

    public ?array $authors = [];

    public ?array $categories = [];

    public ?float $minPrice = null;

    public ?float $maxPrice = null;

    public ?array $publishingHouses = [];

    public ?string $orderBy = 'id';

    public ?string $direction = 'ASC';

    public ?int $limit = 25;

    public ?int $page = 1;
}
