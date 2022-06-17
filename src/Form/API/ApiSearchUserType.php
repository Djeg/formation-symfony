<?php

declare(strict_types=1);

namespace App\Form\API;

use App\Form\SearchUserType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiSearchUserType extends SearchUserType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
