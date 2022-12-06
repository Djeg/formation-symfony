<?php

declare(strict_types=1);

namespace App\DTO;

/**
 * Cette classe contient les champs du formulaire de recherche
 * pour les biens immobilier.
 */
class RealPropertySearchCriteria
{
    /**
     * Cette constantes contient tout les champs
     * pouvant trier un bien immobilier
     */
    const ORDER_FIELDS = [
        'createdAt',
        'updatedAt',
        'label',
        'type',
        'price',
    ];

    /**
     * Cette constante contient les possibles
     * direction de trie (ascendant ou descendant)
     */
    const DIRECTIONS = [
        'DESC',
        'ASC',
    ];

    /**
     * Contient le page
     */
    public int $page = 1;

    /**
     * Contient la limite de bien immobilier
     * affiché à l'écran
     */
    public int $limit = 12;

    /**
     * Contient le champ du trie des bien
     * immobilier
     */
    public string $orderBy = self::ORDER_FIELDS[0];

    /**
     * Contient la direction du trie
     */
    public string $direction = self::DIRECTIONS[0];

    /**
     * Contient le type voulue pour ce bien
     */
    public ?string $type = null;

    /**
     * Contient la surface minimum en m2 du bien
     * immobilier
     */
    public ?int $minTotalArea = null;

    /**
     * Contient la surface maximum du bien en m2
     */
    public ?int $maxTotalArea = null;

    /**
     * Contient le prix minimum du bien souhaité
     */
    public ?int $minPrice = null;

    /**
     * Contient le prix maximum du bien souhaité
     */
    public ?int $maxPrice = null;

    /**
     * Contient le nomber minimum de piéces souhaitées
     */
    public ?int $minRooms = null;

    /**
     * Contient le nombre maximum de pièces souhaitees
     */
    public ?int $maxRooms = null;

    /**
     * Contient l'adresse souhaité
     */
    public ?string $address = null;

    /**
     * Retourne les choix possibles pour le trie des biens immobilier
     */
    public static function getOrderByChoices(): array
    {
        $labels = [
            'Date de création',
            'Date de mise à jour',
            'Titre',
            'Type',
            'Prix',
        ];

        return array_combine($labels, self::ORDER_FIELDS);
    }

    /**
     * Retourne les choix disponible pour les directions 
     */
    public static function getDirectionChoices(): array
    {
        $labels = [
            'Décroissant',
            'Croissant',
        ];

        return array_combine($labels, self::DIRECTIONS);
    }
}
