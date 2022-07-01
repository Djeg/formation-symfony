<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\PizzaTable;
use App\View\ListPizzaView;

/**
 * Contient la logique de la page de liste des pizzas
 */
class ListPizzaController
{
    /**
     * Liste les pizzas
     */
    public function start(): ListPizzaView
    {
        $table = new PizzaTable();

        return new ListPizzaView($table->findAll());
    }
}
