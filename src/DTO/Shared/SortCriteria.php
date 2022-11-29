<?php

declare(strict_types=1);

namespace App\DTO\Shared;

/**
 * Contient les critéres de recherhe pour faire un trie
 */
trait SortCriteria
{
    /**
     * Contient le champ de trie
     */
    public string $orderBy = 'createdAt';

    /**
     * Contient la direction du trie
     */
    public string $direction = 'DESC';
}
