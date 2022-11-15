# La Request et les formulaires

Symfony **interdit** l'utilisation des **superglobal** ($\_GET, $\_POST, $\_SERVER etc ...)

Cependant, symfony possède un objet : Request. Cette objet nous permet de manipuler les données de la requête, tout comme les **superglobal** php !

## Traiter les données d'un formulaire en method GET

Immaginons le formulaire suivant :

```html
<form method="GET">
  <input type="email" name="email" placeholder="votre email" />
  <input type="password" name="password" placeholder="votre mot de passe" />
  <button type="submit">Envoyer</button>
</form>
```

Je souhaiterais récupérer dans mon controller les données de ce formulaire. Pour cela je vais avoir besoin de la Request et de récupérer les données GET (les **queries**) :

```php
use Symfony\Component\HttpFoundation\Request;

public function index(Request $request): Response
{
  // Pour récupérer l'email :
  $email = $request->queries->get('email');
  // Pour récupérer le mot de passe :
  $password = $request->queries->get('password');

  // On peut tester si une données éxiste :
  $request->queries->has('email'); // true
}
```

## Traiter les données d'un formulaire en method POST

Immaginons le formulaire suivant :

```html
<form method="POST">
  <input type="email" name="email" placeholder="votre email" />
  <input type="password" name="password" placeholder="votre mot de passe" />
  <button type="submit">Envoyer</button>
</form>
```

Je souhaiterais récupérer dans mon controller les données de ce formulaire. Pour cela je vais avoir besoin de la Request et de récupérer les données POST (les **request**) :

```php
use Symfony\Component\HttpFoundation\Request;

public function index(Request $request): Response
{
  // Pour récupérer l'email :
  $email = $request->request->get('email');
  // Pour récupérer le mot de passe :
  $password = $request->request->get('password');

  // On peut tester si une données éxiste :
  $request->request->has('email'); // true
}
```

## Connaître et traiter la méthode HTTP

Il est possible de faire du code différent en fonction de la méthode HTTP
de la request

```php
use Symfony\Component\HttpFoundation\Request;

#[Route('/login', name: 'app_user_login', methods: ['GET', 'POST'])]
public function index(Request $request): Response
{
  // Nous pouvons tester la méthode d'un controller :
  if ($request->isMethod(Request::METHOD_POST)) {
    // Je traite les données du formulaire !
  }

  // sinon j'affiche le formulaire
}
```

## Efféctuer une redirection vers une autre Route

Il est possible d'efféctuer des redirections vers une autre route dans un controller.
Pour cela, il faut utiliser la méthode `redirectToRoute` de notre controller :

```php
use Symfony\Component\HttpFoundation\Request;

#[Route('/bienvenue', name: 'app_user_welcome')]
public function welcome(): Response
{
  // Code de bienvenue ...
}

#[Route('/login', name: 'app_user_login', methods: ['GET', 'POST'])]
public function index(Request $request): Response
{
  // Nous pouvons tester la méthode d'un controller :
  if ($request->isMethod(Request::METHOD_POST)) {
    // Je traite les données du formulaire !

    return $this->redirectToRoute('app_user_welcome');
  }

  // sinon j'affiche le formulaire
}
```
