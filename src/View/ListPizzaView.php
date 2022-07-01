<?php

declare(strict_types=1);

namespace App\View;

/**
 * Contient les données de la page de liste des pizzas
 */
class ListPizzaView
{
    /**
     * Contient la liste des pizzas
     */
    public array $list;

    /**
     * Pour construire cette objet, nous devons lui
     * spécifier la liste des pizzas
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }
}
