<?php

declare(strict_types=1);

namespace App\DTO\Shared;

/**
 * Contient le champ de recherche textuelle
 */
trait SearchTextCriteria
{
    /**
     * Contient le texte de recherche pour les annonces
     */
    public ?string $searchText = null;
}
