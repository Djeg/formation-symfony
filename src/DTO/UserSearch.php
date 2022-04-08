<?php

declare(strict_types=1);

namespace App\DTO;

/**
 * Contient tout les critères de recherche d'un utilisateur
 * 
 * @see App\Form\UserSearchType
 */
class UserSearch
{
    /**
     * Contient le nombre d'utilisateurs maximum que nous
     * voulons afficher
     */
    public int $limit = 15;

    /**
     * Contient la page que nous souhaitons consulter
     */
    public int $page = 1;

    /**
     * Contient le champs par lequel nous souhaitons
     * trier les résultats
     */
    public string $sortBy = 'id';

    /**
     * Contient la diréction du trie:
     * Croissant : ASC
     * Décroissant : DESC
     */
    public string $direction = 'ASC';
}
