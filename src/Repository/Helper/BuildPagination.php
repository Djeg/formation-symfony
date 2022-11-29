<?php

declare(strict_types=1);

namespace App\Repository\Helper;

use Doctrine\ORM\QueryBuilder;

/**
 * Ce trait est responable de la construction d'un pagination
 * en utilisant un query builder
 */
trait BuildPagination
{
    /**
     * Construit la pagination
     */
    public function buildPagination(QueryBuilder $builder, $criteria): self
    {
        $builder
            ->setMaxResults($criteria->limit)
            ->setFirstResult(($criteria->page - 1) * $criteria->limit);

        return $this;
    }
}
