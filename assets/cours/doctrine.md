# Le Model avec Doctrine

Doctrine est outil très puissant qu'utilise symfony.

Il est basé sur l'architecture : DataMapper qui stipule la chose
suivante :

- Un entitée : Représente une entrée de notre base de données
- Un Repository : Représente une table de la base de données

## Créer ses propres « Entity » et « Repository »

Pour créer une entité, il suffit de lancer la commande suivante :

```bash
# Si vous n'utilisez pas docker
symfony console make:entity nomEntite
# Si vous utilisez docker
bin/sf console ma:en nomEntite
```

Cela vous lancer l'utilitaire de création d'entité. Il suffit
de se laisser guider afin de créer nos entités.

> **ATTENTION**
> Il est très important avant de lancer la commande de connaître la structure de votre base de données.

## Mettre à jour la base de données

Pour mettre à jour la base de données, il faut utiliser la commande suivante :

```bash
# Sans docker
symfony console doctrine:schema:update --force
# Avec docker
bin/sf console do:sc:up --force
```

## Utiliser doctrine :

Dans un controller, vous pouvez facilement utiliser le « Repository » et / ou « l'Entity » de votre choix :

```php
#[Route('/', name: 'app_home_index', methods: ['GET'])]
public function index(BookRepository $repository): Response
{
    // J'ai envie de récuperer tout les livres de ma base de données
    $books = $repository->findAll();

    // J'ai envie de récupérer le livre avec l'id 10
    $book = $repository->find(10);

    // J'ai enve de récuperer le livre avec le titre "Harry Potter"
    $book = $repository->findOneBy([
        'title' => 'Harry Potter',
    ]);

    // Je souhaiterais de récupérer les 10 derniers livres
    $books = $repository->findBy([], ['createdAt', 'DESC'], 10);

    // Je souhaiterais créer un nouveau livre
    $book = (new Book())
        ->setTitle('Super book')
        ->setDescription('super description')
        ->setGenre('Science-Fiction')
        ->setCreatedAt(new DateTime())
        ->setUpdatedAt(new DateTime());

    // Enregistrement du livre dans la base
    $repository->save($book, true);

    // Mettre à jour un livre avec la même commande :
    $book->setTitle('Nouveau titre');

    $repository->save($book, true);

    // Supprime un libre
    $repository->remove($book, true);

    return new Response("Page d'accueil");
}
```
