<?php

declare(strict_types=1);

namespace App\Model\Table;

use PDO;
use App\Model\DTO\Pizza;
use App\Model\DTO\NewPizza;

/**
 * Représente toutes les opérations disponible sur la table
 * des pizzas
 */
class PizzaTable extends BaseTable
{
    const TABLE_NAME = 'pizzas';

    /**
     * Insert une nouvelle pizza dans la base de données
     */
    public function insertOne(NewPizza $pizza): void
    {
        $tableName = self::TABLE_NAME;
        $request = <<<SQL
            INSERT INTO $tableName
            (
                name,
                description,
                price,
                imageUrl
            ) VALUES (
                ?, ?, ?, ?
            )
        SQL;

        // Préparation et éxécution de la requête SQL
        $statement = $this->pdo->prepare($request);
        $statement->execute([
            $pizza->name,
            $pizza->description,
            $pizza->price,
            $pizza->imageUrl,
        ]);
    }

    /**
     * Récupére toutes les pizzas de la base de données
     */
    public function findAll(): array
    {
        $tableName = self::TABLE_NAME;
        $request = <<<SQL
            SELECT *
            FROM $tableName
        SQL;

        $statement = $this->pdo->prepare($request);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Pizza::class);
    }
}
