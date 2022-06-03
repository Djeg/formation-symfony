<?php

declare(strict_types=1);

namespace App\TPRPG;

class Magician extends Character
{
    public function __construct(
        string $name,
        int $maxLife,
        Weapon $weapon,
    ) {
        parent::__construct($name, $maxLife - 10, $weapon);
    }
}
