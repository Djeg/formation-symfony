<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\PizzaTable;
use App\View\NewPizzaView;

/**
 * Contient la logique de la page new-pizza.php
 */
class NewPizzaController
{
    /**
     * Démarre le controlleur
     */
    public function start(): NewPizzaView
    {
        $view = new NewPizzaView();
        $table = new PizzaTable();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation du nom de la pizza
            if (!$view->pizza->name || strlen($view->pizza->name) < 3) {
                $view->error->name = 'Le nom de la pizza est trop court (2 caractères minimum)';

                return $view;
            }

            // Validation du prix de la pizza
            if (!$view->pizza->price || $view->pizza->price <= 0.0) {
                $view->error->price = 'Le prix doit être supérieur à 0';

                return $view;
            }

            // Validation de l'url de l'image
            if (!$view->pizza->imageUrl || !filter_var($view->pizza->imageUrl, FILTER_VALIDATE_URL)) {
                $view->error->imageUrl = "Invalide url d'image";

                return $view;
            }

            // On insert la pizza dans la table
            $table->insertOne($view->pizza);

            die(var_dump('Pizza créé !'));

            header('Location: /admin/pizza-list.php');

            return $view;
        }

        return $view;
    }
}
