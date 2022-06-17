<?php

declare(strict_types=1);

namespace App\Form\API;

use App\Form\SearchAuthorType;

class ApiSearchAuthorType extends SearchAuthorType
{
    public function getBlockPrefix(): string
    {
        return '';
    }
}
