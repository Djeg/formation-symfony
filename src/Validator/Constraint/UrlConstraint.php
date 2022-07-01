<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

/**
 * Permet de valider une URL
 */
class UrlConstraint implements Constraint
{
    /**
     * @inheritdoc
     */
    public function validate($value, $subject): ?string
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            return 'Cette url est invalide';
        }

        return null;
    }
}
