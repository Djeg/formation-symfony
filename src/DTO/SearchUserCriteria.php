<?php

declare(strict_types=1);

namespace App\DTO;

class SearchUserCriteria
{
    public ?int $limit = 25;

    public ?int $page = 1;

    public ?string $sortBy = 'id';

    public ?string $direction = 'DESC';
}
