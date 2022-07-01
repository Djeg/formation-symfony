<?php

declare(strict_types=1);

namespace App\Controller;

use PDO;
use App\Model\DTO\NewUser;
use App\Model\DTO\NewUserError;
use App\Model\Table\UserTable;
use App\Validator\Constraint\EmailConstraint;
use App\Validator\Constraint\LengthConstraint;
use App\Validator\Constraint\NotBlankConstraint;
use App\Validator\Constraint\SameAsConstraint;
use App\Validator\Validator;
use App\View\InscriptionView;
use LengthException;

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
        // Création de la table user
        $table = new UserTable();

        // On test si le formulaire à bien était envoyé :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validation du nouvel utilisateur
            $validator = (new Validator())
                ->addConstraint('firstname', [
                    new NotBlankConstraint(),
                    new LengthConstraint(2),
                ])
                ->addConstraint('lastname', [
                    new NotBlankConstraint(),
                    new LengthConstraint(2),
                ])
                ->addConstraint('email', [
                    new NotBlankConstraint(),
                    new EmailConstraint(),
                ])
                ->addConstraint('password', [
                    new NotBlankConstraint(),
                    new LengthConstraint(6),
                ])
                ->addConstraint('repeatedPassword', [
                    new NotBlankConstraint(),
                    new SameAsConstraint('password'),
                ]);


            if (!$validator->validate($newUser)) {
                return new InscriptionView($newUser, $validator->fill($errors));
            }

            // Enregistrement en base de données !
            // 1 connéction à la base de données
            $table->insertOne($newUser);

            // Rediréction vers la page de connection
            header('Location: /connexion.php');

            // On retourne la vue de l'inscription
            return new InscriptionView($newUser, $errors);
        }

        // On retourne la vue de l'inscription
        return new InscriptionView($newUser, $errors);
    }
}
