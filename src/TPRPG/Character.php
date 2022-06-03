<?php

declare(strict_types=1);

namespace App\TPRPG;

/**
 * Ajouter une méthode "isDead" qui retourne vrai si le personnage
 * est mort et faux sinon.
 * 
 * Ajouter une méthode "heal" qui accèpte un entier et qui soigne le
 * personnage du montant spécifier en paramètre (attention on ne peut
 * pas depasser le maxLife !!!)
 */
class Character
{
    private string $name;

    private int $maxLife;

    private int $life;

    private Weapon $weapon;

    public function __construct(
        string $name,
        int $maxLife,
        Weapon $weapon,
    ) {
        $this->name = $name;
        $this->maxLife = $maxLife;
        $this->life = $maxLife;

        if (!$weapon->isEquippable($this)) {
            throw new \Exception("$this->name can not equip $weapon !");
        }

        $this->weapon = $weapon;
    }

    public function __toString(): string
    {
        return "$this->name (life: $this->life, weapon: $this->weapon)";
    }

    public function attack(Character $character): string
    {
        $damage = $this->weapon->hit();
        $character->life -= $damage;

        if ($character->isDead()) {
            $character->life = 0;
        }

        return "$this->name dealt $damage to $character->name (new life: $character->life)";
    }

    public function isDead(): bool
    {
        // Manière longue
        // if ($this->life === 0) {
        //     return true;
        // }
        // return false;

        // Manière courte
        return $this->life <= 0;
    }

    public function heal(int $heal): string
    {
        $this->life += $heal;

        if ($this->life > $this->maxLife) {
            $this->life = $this->maxLife;
        }

        return "$this->name healed $heal life points to himself (new life: $this->life)";
    }
}
