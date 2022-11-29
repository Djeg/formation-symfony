<?php

declare(strict_types=1);

namespace App\Repository\Helper;

use Doctrine\ORM\QueryBuilder;

/**
 * Construit la trie en fonction de critéres de recherche
 */
trait BuildSort
{
    /**
     * Met en place le trie en fonction des critéres de rechecher
     */
    public function buildSort(QueryBuilder $builder, string $alias, $criteria): self
    {
        $builder->orderBy("{$alias}.{$criteria->orderBy}", $criteria->direction);

        return $this;
    }
}
