# Les fixtures

Tout d'abord installer le "bundle" suivant: `composer require hautelook/alice-bundle`.

## Créer votre premier fichier de fixtures

Dans le répertoire `fixtures`, créer un nouveau fichier `data.yml` et renseigner
à l'intérieur 3 catégories : `Science Fiction`, `Fantaisie`, `Policier`.

Insérer les fixtures dans la base de données avec la commande : `symfony console hautelook:fixtures:load`

## Générer sa propre base de données

Dans le fichier `data.yml`, créer une base données complète :

- 50 catégories
- 50 auteurs
- Une centaine de livres (Les livres doivent attaché à un auteur et des catégories)

> Vous pouvez vous aider du fichier [data.yml](https://github.com/Djeg/formation-symfony/blob/session/21-03-22.25-03-22/fixtures/data.yml)
