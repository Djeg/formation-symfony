<?php

declare(strict_types=1);

namespace App\DTO;

class SearchDishCriteria
{
    public ?string $title = null;

    public int $limit = 15;

    public int $page = 1;
}
