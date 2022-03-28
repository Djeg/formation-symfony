<?php

declare(strict_types=1);

namespace App\DTO\Admin;

class AdminCategorySearch
{
    public int $limit = 10;

    public int $page = 1;

    public string $sortBy = 'id';

    public string $direction = 'ASC';

    public ?string $name = null;
}
