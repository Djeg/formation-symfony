<?php

declare(strict_types=1);

namespace App\DTO;

interface SearchCriteria
{
	public function getLimit(): int;

	public function getPage(): int;
}
