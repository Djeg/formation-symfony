<?php

declare(strict_types=1);

namespace App\DTO;

class SearchBook
{
    public $title;

    public $limit;

    public $page;

    public $sortBy;

    public $direction;

    public $authorName;

    public $categories;
}
