<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\User;

/**
 * Contient tout les champs de recherche pour des commandes.
 * 
 * @see App\Form\OrderSearchType
 */
class OrderSearch
{
    /**
     * Contient le nombre maximum de commandes
     * que nous souhaitons afficher
     */
    public int $limit = 15;

    /**
     * Contient la page que nous souhaitons afficher
     */
    public int $page = 1;

    /**
     * Contient le champs par lequel nous souhaitons
     * trier les commandes
     */
    public string $sortBy = 'createdAt';

    /**
     * Contient la diréction du trie
     */
    public string $direction = 'DESC';

    /**
     * Contient la liste des status que nous voulons
     * afficher
     */
    public ?array $statuses = null;

    /**
     * Contient l'utilisateur pour lequel nous voulons
     * afficher les commandes
     */
    public ?User $user = null;
}
