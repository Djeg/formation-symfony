<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

/**
 * Permet de valider si oui ou non un champ est remplie
 */
class NotBlankConstraint implements Constraint
{
    /**
     * @inheritdoc
     */
    public function validate($value, $subject): ?string
    {
        if (empty($value)) {
            return 'Cette valeur ne peut pas être vide';
        }

        return null;
    }
}
