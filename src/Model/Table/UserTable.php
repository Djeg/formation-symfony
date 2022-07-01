<?php

declare(strict_types=1);

namespace App\Model\Table;

use PDO;
use App\Model\DTO\NewUser;

/**
 * Représente la table des utilisateurs en base de données
 */
class UserTable extends BaseTable
{
    /**
     * Contient le nom de la table
     */
    const TABLE_NAME = 'users';

    /**
     * Insère un nouvel utilisateur dans la base de données
     */
    public function insertOne(NewUser $newUser): void
    {
        $tableName = self::TABLE_NAME;
        $request = <<<SQL
            INSERT INTO $tableName
            (
                firstname,
                lastname,
                email,
                password,
                phone,
                city,
                zipCode,
                street,
                supplement
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        SQL;

        $statement = $this->pdo->prepare($request);
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
    }

    /**
     * Retourne un utilisateur ou bien false par son email
     */
    public function findOneByEmail(string $email): ?array
    {
        $tableName = self::TABLE_NAME;
        $request = <<<SQL
            SELECT *
            FROM $tableName
            WHERE email = ?
            LIMIT 1
        SQL;

        // 2. Préparation de la requête SQL
        $statement = $this->pdo->prepare($request);

        $statement->execute([$email]);

        // Récupération de ce qu'il y a en base de données
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
