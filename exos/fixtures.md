# Les fixtures

Tout d'abord installer le "bundle" suivant: `composer require hautelook/alice-bundle`.

## Créer votre premier fichier de fixtures

Dans le répertoire `fixtures`, créer un nouveau fichier `data.yml` et renseigner
à l'intérieur 3 catégories : `Science Fiction`, `Fantaisie`, `Policier`.

Insérer les fixtures dans la base de données avec la commande : `symfony console hautelook:fixtures:load`
