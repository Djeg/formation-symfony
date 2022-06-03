<?php

declare(strict_types=1);

namespace App\TPRPG;

class Sword extends Weapon
{
    public function __construct()
    {
        parent::__construct('Sword', 10, 25);
    }

    public function isEquippable(Character $character): bool
    {
        if ($character instanceof Warrior) {
            return true;
        }

        return false;
    }
}
