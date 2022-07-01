<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

/**
 * Définie le contrat d'utilisation d'une contrainte de validation.
 */
interface Constraint
{
    /**
     * Un contraint doit contenir au moins une méthode « validate »
     * accéptant 2 paramètres :
     * - La valeur à valider
     * - Sujet de la validation (généralement l'objet que nous souhaitons valider)
     * 
     * Cette méthode doit retourner une chaine de caractère avec l'erreur
     * ou bien "null" si aucune erreur n'est présente.
     */
    public function validate($value, $subject): ?string;
}
