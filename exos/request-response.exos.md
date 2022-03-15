# Exercices sur la Request et La Response

## Dire bonjour à quelqu'un

Dans un controller `HelloController` ajouter un méthode
`bonjour` avec la route suivante : `/bonjour/{nom}`.

Retourner via la `Response` le text suivant :
`Bonjour $nom, comment allez vous ?`

## Calculatrice, l'addition

Dans un controller `CalculatriceController`. Ajouter une méthode
`additionner` qui accépte la route suivante : `/additionner/{x}/{y}`.

Retourner via la `Response` le text suivant :
`$x + $y = $resultat`

## Calculatrice, la soustraction

Dans un controller `CalculatriceController`. Ajouter une méthode
`soustaire` qui accépte la route suivante : `/soustraction/{x}/{y}`.

Retourner via la `Response` le text suivant :
`$x - $y = $resultat`

## Calculatrice, la multiplication

Dans un controller `CalculatriceController`. Ajouter une méthode
`multiplier` qui accépte la route suivante : `/multiplication/{x}/{y}`.

Retourner via la `Response` le text suivant :
`$x * $y = $resultat`

## Calculatrice, la division

Dans un controller `CalculatriceController`. Ajouter une méthode
`diviser` qui accépte la route suivante : `/division/{x}/{y}`.

Retourner via la `Response` le text suivant :
`$x / $y = $resultat`

## Calculatrice, calculer

Dans un controller `CalculatriceController`. Ajouter une méthode
`calculer` qui accépte la route suivante : `/calcul/{x}/{y}`.

Graçe à un en-tête HTTP : `operation`, faire en sorte de deviner
l'opération à faire. Si l'en-tête http `operation` est égale à :

| additionner | +   |
| ----------- | --- |
| soustraire  | -   |
| multiplier  | \*  |
| diviser     | /   |

Retourner via la `Response` le text suivant :
`$x $operation $y = $resultat`

## Calculatrice, calculer avec précision

Dans un controller `CalculatriceController`. Dans la méthode
calculer plus haut.

Grace à un filtre (query string) `precision` et aussi graçe
à la fonction php : [`round`](https://www.php.net/manual/fr/function.round.php) faire
en sorte de spécifier le nombre de décimaux voulu après la virgule.

Par éxemple: si précision est ègale à 2, alors je devrais
avoir que 2 nombre après la virgule.

## Calculatrice, calculer et gérer les erreur

Dans un controller `CalculatriceController`. Dans la méthode
calculer plus haut.

Si il n'y a pas d'en-tête http `operation`, alors retourner
une réponse avec le code HTTP `400`.
