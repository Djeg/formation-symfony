# Les API Rest avec symfony

Avant même de pouvoir créer sa première avec symfony, il nous faut tout d'abord installer le support de `JSON`

> Et oui ... Blague : Symfony est un framework « moderne » qui ne supporte JSON de base ...

```bash
# sans docker
symfony composer require symfony-bundles/json-request-bundle
# avec docker
bin/sf composer require symfony-bundles/json-request-bundle
```

## Créer son premier « endpoint »

Pour créer un « endpoint » (ex: /addresses), il suffit de tout d'abord créer un controller pour notre
api et nos adresses :

```bash
# sans docker
symfony console make:controller ApiAddress
# avec docker
bin/sf console ma:con ApiAddress
```

Nous pouvons ajouter une méthode correspondant au « endpoint » de notre api :

```php
#[Route('/api/addresses', name: 'app_apiAddress_list', methods: ['GET'])]
public function list(AddressRepository $repository): Response
{
  $addresses = $repository->findAll();

  return $this->json($addresses);
}
```

Donc, pout transformer n'importe quelle entité en JSON, il suffit dans un controller de lancer :

```php
return $this->json($entity);
```

Il est possible d'ignore certains champs de nos entité lors de la transformation en JSON. Et oui, un problème peut survenir très vite ... Les adresses sont relié à un utilisateur, mais l'utilisateur et lui aussi relié à des adresses, et ces adresse sont à nouveau relié aux utilisateurs ... Nous rencontrons un problème de récursion (boucle infinie).

Afin d'éviter les boucles infinie, il suffit d'ouvrir l'entité « Address » et d'ignorer la propriété user de notre JSON en utilisant l'attribut PHP `Ignore` :

```php
#[Ignore]
#[ORM\ManyToOne(inversedBy: 'addresses')]
#[ORM\JoinColumn(nullable: false)]
private ?User $user = null;
```
