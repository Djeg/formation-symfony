<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\UserTable;
use PDO;
use App\View\ConnexionView;

/**
 * Class contenant la logique de la page de connexion
 */
class ConnexionController
{
    /**
     * Function permettant de démarrer la page de connexion
     */
    public function start(): ConnexionView
    {
        session_start();

        // Création de la vue qui contient les crédentielles et les
        // erreurs reliées au crédentielles
        $view = new ConnexionView();

        // Création de la table user
        $table = new UserTable();

        // Vérifier que le formulaire à bien était envoyé
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Valider les champs du formulaire
            if (!$view->credential->email || !filter_var($view->credential->email, FILTER_VALIDATE_EMAIL)) {
                $view->error->email = 'Invalide email';

                return $view;
            }

            if (!$view->credential->password || strlen($view->credential->password) < 6) {
                $view->error->password = 'Mot de passe trop court';

                return $view;
            }

            // Enregistrement en base de données !
            // 1 connéction à la base de données
            $user = $table->findOneByEmail($view->credential->email);

            // Vérifier si l'email correspond à une utilisateur dans la base de données
            if (false === $user) {
                $view->error->email = 'Invalide email';

                return $view;
            }

            // Que les mots de passe correspondents
            if (!password_verify($view->credential->password, $user['password'])) {
                $view->error->password = 'Votre mot de passe est invalide';

                return $view;
            }

            // Enregistrement de l'utilisateur en session
            $_SESSION['user'] = $user;

            // rediriger vers la page de liste des pizzas
            die(var_dump('Connexion OK !'));
        }

        return $view;
    }
}
