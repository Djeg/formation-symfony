<?php

declare(strict_types=1);

namespace App\Validator;

/**
 * La validator est une class de validation générique
 * fonctionnant avec des contraintes.
 * 
 * Il accépte tout d'abord des contraintes gràce à la méthode
 * « addConstraint ».
 * 
 * Il peut ensuite lancer la validation d'un sujet en utilisant
 * la méthod « validate($subject) »
 */
class Validator
{
    private array $constraints = [];

    private array $errors = [];

    /**
     * Ajout une contrainte de validation sur un champ
     */
    public function addConstraint(string $name, array $constraints): self
    {
        $this->constraints[$name]  = $constraints;

        return $this;
    }

    /**
     * Valide ou non un objet en fonction des contraintes spécifié
     * plus haut
     */
    public function validate($object): bool
    {
        foreach ($this->constraints as $name => $constraints) {
            $fieldErrors = [];


            foreach ($constraints as $constraint) {
                $error = $constraint->validate($object->{$name}, $object);

                if ($error) {
                    $fieldErrors[] = $error;
                }
            }

            if (!empty($fieldErrors)) {
                $this->errors[$name] = $fieldErrors;
            }
        }


        return empty($this->errors);
    }

    /**
     * Remplie un objet avec les erreurs de validation
     */
    public function fill($object): mixed
    {
        foreach ($this->errors as $name => $value) {
            $object->{$name} = $value;
        }

        return $object;
    }
}
