<?php

declare(strict_types=1);

namespace App\DTO;

use Doctrine\Common\Collections\Collection;

class SearchBook
{
    public ?string $title = null;

    public int $limit = 20;

    public int $page = 1;

    public string $sortBy = 'id';

    public string $direction = 'ASC';

    public ?string $authorName = null;

    public ?Collection $categories = null;
}
