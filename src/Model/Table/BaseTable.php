<?php

declare(strict_types=1);

namespace App\Model\Table;

use PDO;

/**
 * Cette class est la classe de base de n'importe quelle table
 * de la base de données. Son rôle est de contenir et de définir
 * PDO à un seul endroit
 */
abstract class BaseTable
{
    protected PDO $pdo;

    /**
     * Construit la table de base en instanciant PDO
     */
    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=pizza-shop-php;host=127.0.0.1;port=5050', 'root', 'root');
    }
}
