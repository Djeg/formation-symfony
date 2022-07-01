<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

/**
 * Permet de vérifier qu'une valeur soit identique
 * à une autre valeur du sujet
 */
class SameAsConstraint implements Constraint
{
    private string $fieldName;

    public function __construct(string $fieldName)
    {
        $this->fieldName = $fieldName;
    }

    /**
     * @inheritdoc
     */
    public function validate($value, $object): ?string
    {
        if ($value !== $object->{$this->fieldName}) {
            return 'Les deux valeurs doivent être identique';
        }

        return null;
    }
}
