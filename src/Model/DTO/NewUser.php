<?php

declare(strict_types=1);

namespace App\Model\DTO;

/**
 * Cette classe représente un nouvelle utilisateur
 * de notre pizzeria. Elle contient sous forme
 * de propriétés tout les champs du formulaire
 * d'inscription.
 */
class NewUser
{
    public ?string $firstname = '';

    public ?string $lastname = '';

    public ?string $password = '';

    public ?string $repeatedPassword = '';

    public ?string $phone = '';

    public ?string $city = '';

    public ?string $zipCode = '';

    public ?string $street = '';

    public ?string $supplement = '';

    /**
     * Lors de la construction de l'objet on remplie les propriétés
     * de l'objet avec les données POST du formulaire
     */
    public function __construct()
    {
        // On remplie l'objet avec les données du formulaire en POST
        $this->firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $this->lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $this->email = isset($_POST['email']) ? $_POST['email'] : '';
        $this->password = isset($_POST['password']) ? $_POST['password'] : '';
        $this->repeatedPassword = isset($_POST['repeatedPassword']) ? $_POST['repeatedPassword'] : '';
        $this->phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $this->city = isset($_POST['city']) ? $_POST['city'] : '';
        $this->zipCode = isset($_POST['zipCode']) ? $_POST['zipCode'] : '';
        $this->street = isset($_POST['street']) ? $_POST['street'] : '';
        $this->supplement = isset($_POST['supplement']) ? $_POST['supplement'] : '';
    }
}
