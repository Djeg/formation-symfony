<?php

declare(strict_types=1);

namespace App\TPRPG;

class MagicStick extends Weapon
{
    public function __construct()
    {
        parent::__construct('Magic Stick', 5, 65);
    }

    public function isEquippable(Character $character): bool
    {
        if ($character instanceof Magician) {
            return true;
        }

        return false;
    }
}
