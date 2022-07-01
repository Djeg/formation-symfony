<?php

declare(strict_types=1);

namespace App\Model\DTO;

/**
 * Cette class contient les champs de création d'une
 * nouvelle pizza
 */
class NewPizza
{
    public ?string $name = '';

    public ?string $description = null;

    public ?float $price = 0.00;

    public ?string $imageUrl = '';

    /**
     * Lors de la construction nous remplissons notre objet
     * avec les donées du formulaire
     */
    public function __construct()
    {
        $this->name = isset($_POST['name']) ? $_POST['name'] : '';
        $this->description = isset($_POST['description']) ? $_POST['description'] : '';
        $this->price = isset($_POST['price']) ? (float)$_POST['price'] : 0.00;
        $this->imageUrl = isset($_POST['imageUrl']) ? $_POST['imageUrl'] : '';
    }
}
