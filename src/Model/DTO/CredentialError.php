<?php

declare(strict_types=1);

namespace App\Model\DTO;

/**
 * Contient les erreurs des crédentielles (l'erreur du mot de passe
 * et l'erreur de l'email si il y en as).
 */
class CredentialError extends Credential
{
    /**
     * Lors de la construction nous n'assignons pas les
     * propriétés
     */
    public function __construct()
    {
    }
}
