<?php

declare(strict_types=1);

namespace App\Model\DTO;

/**
 * Contient les possibles erreurs d'un nouvel utilisateur
 */
class NewUserError
{
    public ?array $firstname = [];

    public ?array $lastname = [];

    public ?array $password = [];

    public ?array $email = [];

    public ?array $repeatedPassword = [];

    public ?array $phone = [];

    public ?array $city = [];

    public ?array $zipCode = [];

    public ?array $street = [];

    public ?array $supplement = [];
}
