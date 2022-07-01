<?php

declare(strict_types=1);

namespace App\Model\DTO;

/**
 * Cette objet contient tout les champs d'une pizza
 */
class Pizza
{
    public int $id;

    public string $name;

    public ?string $description;

    public float $price;

    public string $imageUrl;
}
