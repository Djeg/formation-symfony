<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\Address;

/**
 * Cette classe contient les données du formulaire de paiment.
 * Elle est utilisé comme objet de transition entre un paimement
 * et une commande en base de données.
 * 
 * ATTENTION ! Les informations de la carte bleu ne peuvent
 * pas être enregistré en base de données. Cela est illégal,
 * c'est pour cela que nous utilisons ce DTO plut$ot que l'entité
 * Order diréctement :).
 * 
 * @see App\Form\OrderType
 */
class Paiment
{
    /**
     * Contient le numéro de la carte bleu
     */
    public string $number;

    /**
     * Contient le mois d'expiration de la carte
     * bleu
     */
    public string $expirationMonth;

    /**
     * Contient l'année d'expiration de la carte bleu
     */
    public string $expirationYear;

    /**
     * Contient le cryptogramme de sécurité (le code
     * à 3 chiffres) de la carte bleu
     */
    public string $cvc;

    /**
     * Contient l'adresse à laquel les pizzas doivent être
     * livré :)
     */
    public Address $address;
}
