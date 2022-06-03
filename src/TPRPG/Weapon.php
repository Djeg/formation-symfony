<?php

declare(strict_types=1);

namespace App\TPRPG;

/**
 * Ajouter les propriétés suivante (en respectant
 * l'encapsulation) :
 * - string $name
 * - int $min
 * - int $max
 * 
 * Ajouter une méthode "Hit" qui retourne 
 * un nombre aléatoire entre le min et le max
 * 
 * Ajouter une méthode "isEquipable" qui accepte
 * un personnage et retourne Vrai si c'est équipable,
 * faux sinon
 */
abstract class Weapon
{
    private string $name;

    private int $min;

    private int $max;

    public function __construct(
        string $name,
        int $min,
        int $max,
    ) {
        $this->name = $name;
        $this->min = $min;
        $this->max = $max;
    }

    public function Hit(): int
    {
        return rand($this->min, $this->max);
    }

    public function __toString(): string
    {
        return "$this->name ($this->min to $this->max)";
    }

    abstract public function isEquippable(Character $character): bool;
}
