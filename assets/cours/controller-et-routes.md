# Les Controller & les Routes

Un controller c'est une class php, dont le rôle est d'afficher
des pages.

Pour cela chaque méthodes d'un controller doit posséder
un Route.

```php
#[Route('/', name: 'app_home_index', methods: ['GET'])]
public function index(): Response
{
  return new Response("Page d'accueil");
}
```

Les routes accèpte 3 paramètres :

- L'uri de la route (c'est ce que l'on vas taper dans la bare d'adresse de notre navigateur)
- Le nom de la route qui utilise la convention suivante `app_controller_method`
- Les méthodes HTTP ('GET', 'POST', 'PUT', 'PATCH', 'DELETE' ...)

## Les routes dynamiques

Sur la plupart des sites internet moderne, certaine partie de l'uri
peuvent être dynamique :

```
https://mon-site.com/articles/mon-voyage-au-japon
https://mon-site.com/articles/mon-voyage-en-irlande
```

Pour créer une url dynamique, il faut déclarer un « Paramètre de Route » :

```php
#[Route('/articles/{nomArticle}', name: 'app_article_showArticle', methods: ['GET'])]
public function showArticle(string $nomArticle): Response
{
  return new Response("On affiche l'article $nomArticle");
}
```

## Génération de controller

En symfony il est possible de générer un controller :

```bash
# Si vous n'utilisez pas docker
symfony console make:controller nomDuController
# Si vous utilisez docker
bin/sf console make:controller nomDuController
```
