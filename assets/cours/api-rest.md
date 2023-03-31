# Les API Rest(full)

Afin de communiquer avec n'importe quelle application, un serveur se doit d'implémenter une API Web. Cette dernière ne propose aucune interface, ce n'est qu'un intermediaire entre la base de donées et le client.

## Les Resource et Collection

REST est basé sur un système d'url, ou chaque URI peut-être représenté sous forme de « Resource » ou de « Collection »

| URI      | type       | JSON | Base de données |
| -------- | ---------- | ---- | --------------- |
| /books   | Collection | `[]` | table           |
| /me      | Resource   | `{}` | entrée          |
| /books/3 | Resource   | `{}` | entrée          |

## Les actions

Il est possible d'utiliser les « Méthodes HTTP » afin de réaliser des actions sur nos Resources ou Collection :

| Method | Traduction                                                                       |
| ------ | -------------------------------------------------------------------------------- |
| GET    | Obtenir : Récupére des resources ou collection                                   |
| POST   | Créer : Créer une nouvelle Resource ou collection                                |
| PUT    | Modifie l'intégralité : Modifie l'intégralité de la Resource ou de la Collection |
| PATCH  | Modifie une partie : Modifie une parie de la Resource ou de la Collection        |
| DELETE | Supprimer : Supprime un Resource ou un Collection                                |

Par exemple :

| Action | URI      | Traduction                                            |
| ------ | -------- | ----------------------------------------------------- |
| GET    | /books   | Récupére la collection de « book »                    |
| POST   | /books   | Créer la collection (mais aussi la resource) « book » |
| DELETE | /books/3 | On supprime la Resource livre avec l'id 3             |
| PATCH  | /me      | Éditer une partie de mes informations personnel       |

## Les régles immuable !!

### Les resources et collection « s'imbrique »

Comme un jeux de légos, les resources et collections peuvent s'imbriquer :

| Action | URI                      | type       |
| ------ | ------------------------ | ---------- |
| GET    | /books                   | Collection |
| GET    | /books/3                 | Resource   |
| GET    | /books/3/author          | Resource   |
| GET    | /books/3/author/comments | Collection |

On peut rembombiner les resources / collections et toujours retomber sur nos pieds

| Action | URI      | type       | valide |
| ------ | -------- | ---------- | ------ |
| GET    | /books   | Collection | Oui    |
| GET    | /books/3 | Resource   | Oui    |
| GET    | /book    | -          | Non    |
| GET    | /book/3  | Resource   | Non    |

## Les resource et collection sont immuable (ou presque)

Si, pout tel action j'ai Resource alors quelle que soit l'action j'aurais toujours une Resource. Il en est de même pour les collections !

| Action      | URI    | type       |
| ----------- | ------ | ---------- |
| GET         | /books | Collection |
| POST        | /books | Collection |
| PUT / PATCH | /books | Collection |
| DELETE      | /books | Collection |

Un exemple un peu plus difficile

| Action | URI         | type       |
| ------ | ----------- | ---------- |
| GET    | /books?id=2 | Collection |

## Les resources et collection peuvent être filtré

Avec l'utilisation de QueryString, nous pouvons « filtrer » nos resources ou collection.

> ATTENTION : Quelle que soit le filtres, les URI reste IMMUABLE

| Action | URI                                                | type       | explications                                                                   |
| ------ | -------------------------------------------------- | ---------- | ------------------------------------------------------------------------------ |
| GET    | /books?limit=10&page=2&ordery=price&direction=DESC | Collection | Grâce aux query string, je peux séléctionner et filtrer ma collection de livre |

## Dévélopper une API REST avec symfony

Pour commencer à dévélopper une api avec symfony, il faut tout d'abord que Symfony puisse comprendre le `JSON` :

```
symfony composer require symfony-bundles/json-request-bundle
```

### Retourner du JSON, à la place de HTML ?

L'idée d'une api REST est de retourner soit des collections, soit des resources. En symfony, une resource correspond généralement à une entité et les collections se sont généralement des tableaux d'entités !

Pour retourner dans nos controller notre entité ou notre tableaux d'entité en json :

```php
public function test(BookRepository $repository): Response
{
  // Je récupére un tableaux contenant tout les livres
  $books = $repository->findAll();

  // Pour afficher du json :
  return $this->json($books);
}

public function test2(Book $book): Response
{
  return $this->json($book);
}
```

### Ignorer des champs dans votre JSON !

Dans certains cas, nous ne souhaitons pas afficher le champs dans notre objet JSON (information confidentiel etc ...). Il suffit de retoucher l'entité concerné et d'utiliser l'attribut `#[Ignore]` :

```php
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    //....

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Ignore]
    private ?string $password = null;

    // ...
}

```

## Tester des api REST

Pour tester des API Rest (qui utilise JSON et le protocole HTTP), nous avons différents choix.

1. Vous pouvez un client « rest » comme par exemple : [postman](https://www.postman.com/)
2. Une extension VSCode très pratique [REST Client](https://marketplace.visualstudio.com/items?itemName=humao.rest-client)

Pour utiliser VSCode et le REST Client, il faut ou d'abord créer un fichier à la racine du projet nommé `cequevousouhaitez.http` (`request.http`)

Dans ce fichier nous allons pouvoir écrire nos propres HTTP et consulter la vértiable réponse HTTP !

Exemple de fichier `request.http` :

```http
# Le diése permet d'écrire des commentaires
# Le principe est simple, écrire nos propres requêtes HTTP :
GET http://127.0.0.1:12000/api/users
Content-Type: application/json

# Le triple diése permet d'écrire une nouvelle requête
###

GET http://127.0.0.1:12000/api/books
Content-Type: application/json
```

## Les api et les formulaires !

Dans une api, nous avons aussi des formulaires cependant nous n'utilisons sa « view » (il n'y a pas de HTML).

Tout d'abord, pour envoyer des données à notre API dans une requête http, il faut utiliser le format JSON comme ceci :

```http
POST http://127.0.0.1:12000/api/authors
Content-Type: application/json

{
  "title": "John Doe",
  "description": "John Doe description"
}
```

### Le format JSON

JSON est le format de référence des api web aujourd'hui, il est très simple !

```json
// Il existe des types de données :
true // boolean
false // bollean

12 // number
13.5 // number
-15 // number

"John Doe" // string (guillement double obligatoire !)

[12, 15, 18, 9, 12] // array

{
  "username": "john",
  "age": 24
} // objects
```

Il existe des validateurs de JSON directement en ligne :

https://jsoneditoronline.org

### Symfony et les formulaires d'api

Les formulaires d'api en symfony, fonctionne de la même manière que des formulaires classique, avec 2 petites différences :

```php
<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Formulaire d'api pour un auteur
 */
class ApiAuthorType extends AbstractType
{
    /**
     * Les formulaires fonctionne de la même manière que les formulaires classique,
     * cependant, il n'y a pas besoin de spécifier des labels ou un bouton
     * de soumissions (car il n'y pas de HTML, de visuel).
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('nationality', ChoiceType::class, [
                'choices' => [
                    'fr' => 'fr',
                    'en' => 'en',
                    'de' => 'de',
                    'es' => 'es',
                ],
                // Voici les contraintes de validation, il en existe
                // un bon paquet permettant de valider notre données
                // Ici par exemple, nous utilisons `NotBlank`
                // Vous les retrouverez sur le documentation de symfony :
                // https://symfony.com/doc/current/reference/constraints.html
                "constraints" => [
                    new NotBlank(),
                ]
            ]);
    }

    /**
     * Au niveau des options, il suffit tout simplement de désactiver la protection
     * CSRF pour en faire un formulaire d'api
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
            'csrf_protection' => false,
        ]);
    }

    /**
     * Il est fortement conseillé de supprimer le prefix
     */
    public function getBlockPrefix()
    {
        return '';
    }
}

```

### Et le controlleur ?

Pour gérer un formulaire dans un controlleur, c'est encore plus simple :

```php
/**
 * Créer un nouvel auteur
 */
#[Route('/api/authors', name: 'app_api_author_create', methods: ['POST'])]
public function create(Request $request, AuthorRepository $repository): Response
{
    // Je créé le formulaire
    $form = $this->createForm(ApiAuthorType::class);

    // Je remplie le formulaire
    $form->handleRequest($request);

    // Je vérifie si le formulaire est envoyé et valide
    if (!$form->isSubmitted() || !$form->isValid()) {
        // On retourne les erreurs du formulaire ave le code
        // http 400, utilisé pour les erreurs du client
        return $this->json($form->getErrors(true, true), 400);
    }

    // J'enregistre mon auteur
    $repository->save($form->getData(), true);

    // Je retourne l'auteur en json
    return $this->json($form->getData());
}
```

### Et les formulaires de recherche ?

Les formulaire fonctionne de la même manière que les formulaire classique. Il nous faut un DTO contenant les champs de recherche, un form type et ensuite il suffit de spécifier la rechercher graçe à des filtres dans notre requête :

#### Exemple la recherche d'auteur

Le form type :

```php
<?php

namespace App\Form;

use App\DTO\AuthorSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :',
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Limite :',
                // Il nous faut pas oublier de spécifier
                // une valeur par défaut pour les api !
                'empty_data' => 25,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
                // Il nous faut pas oublier de spécifier
                // une valeur par défaut pour les api !
                'empty_data' => 1,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AuthorSearchCriteria::class,
            'method' => 'GET',
            'empty_data' => new AuthorSearchCriteria(),
            'data' => new AuthorSearchCriteria(),
            'csrf_protection' => false,
        ]);
    }

    /**
     * Nous pouvons enlever le petit préfix envoyé dans l'url
     * en personnalisant et vidant la méthode `getBlockPrefix`
     */
    public function getBlockPrefix()
    {
        return '';
    }
}

```

Le controlleur :

```php
/**
 * Liste tout les auteurs
 */
#[Route('/api/authors', name: 'app_api_author_list', methods: ['GET'])]
public function list(AuthorRepository $repository, Request $request): Response
{
    // Je créé mon formulaire de recherche
    $form = $this->createForm(AuthorSearchType::class);

    // Je remplie les données du formulaire
    $form->handleRequest($request);

    // Je récupére les critères de recherche
    $criteria = $form->getData();

    // Je lance la recherche en utilisant le repository
    $authors = $repository->findAllByCriteria($criteria);

    return $this->json($authors);
}
```
