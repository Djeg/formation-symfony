<?php

use App\Kernel;
use App\TPRPG\Warrior;
use App\TPRPG\Magician;
use App\TPRPG\Character;
use App\TPRPG\MagicStick;
use App\TPRPG\Sword;
use App\TPRPG\Weapon;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';


/**
 * Créer 4 armes différentes, 2 éuipale 
 * par des guerriers et 2 équipable par 
 * des magiciens.
 */
$sword = new Sword();
$stick = new MagicStick();

$arthur = new Warrior('Arthur', 100, $stick);
$merlin = new Magician('Merlin', 100, $sword);

echo $arthur;
echo "\n";
echo $merlin;
echo "\n";
echo $arthur->attack($merlin);
echo "\n";

while (!$merlin->isDead()) {
    echo $arthur->attack($merlin);
    echo "\n";
}

echo $merlin->heal(20);
echo "\n";

echo "\n\n\n";
