<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

/**
 * Permet de valider un email
 */
class EmailConstraint implements Constraint
{
    /**
     * @inheritdoc
     */
    public function validate($value, $subject): ?string
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return 'Cet email est invalide';
        }

        return null;
    }
}
