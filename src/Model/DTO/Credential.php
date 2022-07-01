<?php

declare(strict_types=1);

namespace App\Model\DTO;

/**
 * Cette objet contient les crédentielles d'un utilisateur
 * (son email et son mot de passe)
 */
class Credential
{
    public ?string $email = '';

    public ?string $password = '';

    /**
     * Construction de l'objet; nous récupérons
     * les données du formulaire si présente
     */
    public function __construct()
    {
        $this->email = isset($_POST['email']) ? $_POST['email'] : '';
        $this->password = isset($_POST['password']) ? $_POST['password'] : '';
    }
}
