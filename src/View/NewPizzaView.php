<?php

declare(strict_types=1);

namespace App\View;

use App\Model\DTO\NewPizza;
use App\Model\DTO\NewPizzaError;

/**
 * Contient les données utilisé par la page de new-pizza.php
 */
class NewPizzaView
{
    public NewPizza $pizza;

    public NewPizzaError $error;

    /**
     * Lors de la construction nous créons la view et les erreur
     */
    public function __construct()
    {
        $this->pizza = new NewPizza();
        $this->error = new NewPizzaError();
    }
}
