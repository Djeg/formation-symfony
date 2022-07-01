<?php

declare(strict_types=1);

namespace App\Model\DTO;

/**
 * Contient les erreurs du formulaire de création des pizzas
 */
class NewPizzaError extends NewPizza
{
    /**
     * Lors de la construction nous laissons les propriétés
     * de l'objet vide
     */
    public function __construct()
    {
    }
}
