<?php

declare(strict_types=1);

namespace App\DTO;

class SearchBook
{
    public ?string $title = null;

    public int $limit = 10;

    public int $page = 1;

    public string $sortBy = 'id';

    public string $direction = 'DESC';

    public ?string $authorName = null;

    public $categories = null;
}
