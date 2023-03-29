<?php

declare(strict_types=1);

namespace App\DTO;

/**
 * Classe contenant les champs du formulaire de recherche
 * des auteurs.
 */
class AuthorSearchCriteria
{
    public ?string $title = null;

    public int $limit = 25;

    public int $page = 1;
}
