<?php

declare(strict_types=1);

namespace App\Controller;

use PDO;
use App\Model\DTO\NewUser;
use App\Model\DTO\NewUserError;
use App\View\InscriptionView;

/**
 * Voici le controller de la page inscription. Ce controller
 * contient toute la logique de la page d'inscription
 */
class InscriptionController
{
    /**
     * Voici la méthode qui démarre le controller d'inscription et qui retourne
     * la vue : App\View\InscriptionView
     */
    public function start(): InscriptionView
    {
        // Création du nouvel utilisateur
        $newUser = new NewUser();

        // Création des erreurs du nouvel utilisateur
        $errors = new NewUserError();

        // On test si le formulaire à bien était envoyé :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On valide le nom
            if (!$newUser->firstname || strlen($newUser->firstname) < 2) {
                $errors->firstname = 'Vous devez spécifier un prénom de 2 caractères minimum';
            }

            // On valide le prénom
            if (!$newUser->lastname || strlen($newUser->lastname) < 2) {
                $errors->lastname = 'Vous devez spécifier un nom de 2 caractères minimum';
            }

            // On valide l'email
            if (!$newUser->email || !filter_var($newUser->email, FILTER_VALIDATE_EMAIL)) {
                $errors->email = 'Votre email n\'est pas valide';
            }

            // On valide le mot de passe
            if (!$newUser->password || strlen($newUser->password) < 6) {
                $errors->password = 'Votre mot de passe est trop court, 6 caractères minimum';
            }

            // On valide le mot de passe
            if (!$newUser->repeatedPassword || strlen($newUser->repeatedPassword) < 6) {
                $errors->repeatedPassword = 'Votre mot de passe est trop court, 6 caractères minimum';
            }

            // On valie les deux mots de passe
            if ($newUser->password !== $newUser->repeatedPassword) {
                $errors->repeatedPassword = 'Vos deux mot de passes doivent correspondre';
            }

            // On test si il n'y a pas d'erreur
            $hasError = false;
            foreach ($errors as $key => $value) {
                if ($value) {
                    $hasError = true;
                    break;
                }
            }

            if (!$hasError) {
                // Enregistrement en base de données !
                // 1 connéction à la base de données
                $pdo = new PDO('mysql:dbname=pizza-shop-php;host=127.0.0.1;port=5050', 'root', 'root');

                // 2. Préparation de la requête SQL
                $statement = $pdo->prepare('INSERT INTO users (firstname, lastname, email, password, phone, city, zipCode, street, supplement) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $statement->execute([
                    $newUser->firstname,
                    $newUser->lastname,
                    $newUser->email,
                    password_hash($newUser->password, PASSWORD_DEFAULT),
                    $newUser->phone,
                    $newUser->city,
                    $newUser->zipCode,
                    $newUser->street,
                    $newUser->supplement,
                ]);

                // Rediréction vers la page de connection
                header('Location: /connexion.php');

                // On retourne la vue de l'inscription
                return new InscriptionView($newUser, $errors);
            }
        }

        // On retourne la vue de l'inscription
        return new InscriptionView($newUser, $errors);
    }
}
