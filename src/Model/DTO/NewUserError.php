<?php

declare(strict_types=1);

namespace App\Model\DTO;

/**
 * Contient les possibles erreurs d'un nouvel utilisateur
 */
class NewUserError extends NewUser
{
    /**
     * Lors de se construction nous laissons tout les
     * champs vide. C'est l'InscriptionController qui s'occupe
     * de les remplir !
     */
    public function __construct()
    {
    }
}
