<?php

declare(strict_types=1);

namespace App\View;

use App\Model\DTO\NewUser;
use App\Model\DTO\NewUserError;

/**
 * Contient toutes les données nescessaire pour afficher
 * la page d'inscription.
 */
class InscriptionView
{
    /**
     * Contient le nouvel utilisateur
     */
    public NewUser $newUser;

    /**
     * Contient les erreurs du nouvel utilisateur
     */
    public NewUserError $errors;

    /**
     * Afin de se construire cette objet à besoin
     * d'un nouvel utilisateur et de ses erreurs
     */
    public function __construct(
        NewUser $newUser,
        NewUserError $errors,
    ) {
        $this->newUser = $newUser;
        $this->errors = $errors;
    }
}
