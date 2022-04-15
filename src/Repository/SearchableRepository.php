<?php

declare(strict_types=1);

namespace App\Repository;

use App\DTO\SearchCriteria;

interface SearchableRepository
{
	public function findByCriteria(SearchCriteria $criterias): array;
}
