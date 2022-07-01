<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

/**
 * Permet de valider la longueur d'une chaine de caractère
 * gràce à un minimum (min) et un maximum.
 */
class LengthConstraint implements Constraint
{
    private int $min;

    private ?int $max;

    public function __construct(int $min, ?int $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @inheritdoc
     */
    public function validate($value, $subject): ?string
    {
        if (strlen($value) < $this->min) {
            return "Cette valeur doit être de $this->min caractère minimum";
        }

        if ($this->max && strlen($value) > $this->max) {
            return "Cette valeur doit être de $this->min caractère minimum";
        }

        return null;
    }
}
