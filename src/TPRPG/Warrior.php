<?php

declare(strict_types=1);

namespace App\TPRPG;

class Warrior extends Character
{
    public function __construct(
        string $name,
        Weapon $weapon,
        int $maxLife = 100,
    ) {
        parent::__construct($name, $maxLife + 10, $weapon);
    }
}
