<?php

declare(strict_types=1);

namespace App\DTO;

class CategorySearch
{
    public int $limit = 10;

    public int $page = 1;

    public string $sortBy = 'id';

    public string $direction = 'DESC';

    public ?string $name = null;
}