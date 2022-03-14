<?php

// Chiffres Entier : int
10;
new int(10);
23;
190;
-65;


// Chiffres à virgules : float
56.4;
new float(56.4);
.90;
0.90;
-45.3;

// Chaines de caractère : string
"John";
'Jenny';
<<<TEST
  Coucou les amis

  comment ça vas ?
TEST;

// Les booleans : bool
true;
false;

// Les tableaux : array
[13, 14, 9, 17, 20];

class Personnage
{
  protected string $name;

  protected int $life = 100;

  public function sayHello()
  {
    return "Bonjour " . $this->name;
  }

  public function heal(int $vie): void
  {
    $this->life = $this->life + $vie;
  }

  public function attack(Personnage $autrePersonnage): void
  {
    $autrePersonnage->life = $autrePersonnage->life - 10;
  }

  public function getLife(): int
  {
    return $this->life;
  }
}

class Warrior extends Personnage
{
}

class Wizard extends Personnage
{
}


$arthur = new Warrior();
$merlin = new Wizard();
$morgan = new Wizard();

$arthur->name = "Arthur";
$merlin->name = "Merlin";
$morgan->name = "Morganne";

$arthur->heal(40 /* int */);
$arthurLife = $arthur->getLife();
$arthurLife /* int */;

$arthur->attack($merlin /* Personnage */);

echo $arthur->sayHello(); // Bonjour Arthur
echo $merlin->sayHello(); // Bonjour Merlin
echo $morgan->sayHello(); // Bonjour Morgan


class Voiture
{
  private $motor;

  private $transmition;

  public function changeMoteur(string $moteur, string $transmition)
  {
    $this->motor = $moteur;
    $this->transmition = $transmition;
  }
}

$audi = new Voiture();

$audi->changeMoteur('V12', 'A17');
