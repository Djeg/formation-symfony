# Documenter son api

Symfony possède un plugin (bundle) permettant de générer automatiquement une documentation ainsi qu'un espace de test pour notre api.

## NelmioApiDocBundle

La première étape, c'est d'installer « [NelmioApiDoc](https://symfony.com/bundles/NelmioApiDocBundle/current/index.html) » :

```bash
# sans docker
symfony console require nelmio/api-doc-bundle
# avec docker
bin/sf console req nelmio/api-doc-bundle
```

> Si symfony vous demande d'éxécuter les recettes, réponder yes (y)

## Configurer NelmioApiDoc

1. Activer la documentation : Pour cela, rendez-vous dans le fichier `config/routes/nelmio_api_doc.yaml` et décommenté les lignes suivante :

```yaml
# Requires the Asset component and the Twig bundle
# $ composer require twig asset
app.swagger_ui:
  path: /api/doc
  methods: GET
  defaults: { _controller: nelmio_api_doc.controller.swagger_ui }
```

2. Autoriser l'access à la documentation de l'api : Dans le fichier `config/packages/security.yaml`, ajouter la section suivante :

```yaml
security:
  # ....
  access_control:
    # Autorise l'acces à la documentation de l'api pour tout le monde :
    - { path: "^/api/doc", roles: PUBLIC_ACCESS }
```

3. Accéder à la documentation : on se rend sur `http://localhost:12000/api/doc`

## Configurer votre documentation !

On peut facilement configurer la documentation de l'api dans le fichier `config/packages/nelmio_api_doc.yaml` :

```yaml
nelmio_api_doc:
  # Les information generale de votre api
  documentation:
    # Nous pouvons configurer le server de l'api
    servers:
      - url: http://localhost:12000
        description: Serveur de l'api
    info:
      # Titre de votre api
      title: LookBook - API
      # description de votre api
      description: API Rest pour gérer les annonces de livres entre particulier
      version: 1.0.0
    # On peut ajouter des composants, notamant celui de l'authentification
    components:
      # On ajoute un schèma de sécurité
      securitySchemes:
        # On se connect via un Bearer
        jwt:
          type: http
          scheme: Bearer
          bearerFormat: JWT
    # On spécifie la sécurité à utiliser
    security:
      - jwt: []
    # On ajoute la route pour créer un token
    paths:
      # On ajoute la route pour le token
      "/api/token":
        # On spécifie la méthode HTTP
        post:
          summary: Create a new authentification token
          tags:
            - Security
          security: []
          requestBody:
            content:
              application/json:
                schema:
                  type: object
                  properties:
                    username:
                      type: string
                    password:
                      type: string
  areas: # to filter documented areas
    path_patterns:
      - ^/api(?!/doc$) # Accepts routes under /api except /api/doc
```

## Configurer chaque controller

Grâce à une série d'attribut php, il est possible de configurer la documentation de chaque « endpoint » de notre api :

Il faut tout d'abord utiliser le use suivant afin de mettre en place les attributs :

```php
use OpenApi\Attributes as OA;
```

1. Ranger nos endpoints dans des « Tag »

```php
#[OA\Tag(name: 'Address')]
```

2. On peut aussi attacher à nos endpoint des query strings :

```php
#[OA\Parameter(
    in: 'query',
    schema: new OA\Schema(ref: new Model(type: AddressSearchCriteria::class), required: [])
)]
```

3. On peut aussi personaliser les responses :

```php
#[OA\Response(
    response: 200,
    description: 'Retourne la collection d\'adresse',
    // Ici nous retournons un tableaux d'address
    content: new OA\JsonContent(
        type: 'array',
        items: new OA\Items(ref: new Model(type: Address::class))
    )
)]
```

```php
#[OA\Response(
    response: 200,
    description: 'Retourne une seule adresse',
    // Ici nous retournons une seule adresse
    content: new Model(type: Address::class)
)]
```

4. Il est aussi possible de personnaliser le body de la request :

```php
#[OA\RequestBody(content: new Model(type: Address::class))]
```

## Configurer les « schèmas » ou modèles d'api

Il est possible de « grouper » les propriétés d'un objet dans des catégories (ex: email, password, firstname, lastname dans la catégorie « create »). Vous pouvez nommé les catégories comme vous le souhaitez.

Ces catégories sont des groupes de sérialization, il permettent de spécifier précisement ce que l'on veut comme objet dans sa documentation :

```php
#[OA\RequestBody(
  content: new Model(type: Address::class, groups: ['api_create'])
)]
```

Et ensuite je vais pouvoir spécifier ce qui appartient à ce groupe dans la class donnée (Address) :

```php
#[ORM\Column(length: 255)]
#[Groups(['default', 'api_create'])]
private ?string $country = null;
```

> Lorsque vous utiliser dans un controller $this->json, vous pouvez spécifier en 3eme paramètre : `$this->json($address, 200, [], ['groups' => ['api_create']])`

Il est aussi possible de personalisé la propriété dans la documentation :

```php
#[OA\Property(type: 'number', description: 'Id de l\'utilisateur')]
public ?User $user = null;
```
