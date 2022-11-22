# Les formulaires de recherche

Se sont des formulaires un peut particulier, parce qu'il n'insére aucun résultats en base de données.

## Le DTO

Un formulaire à besoin d'une class PHP contenant les champs du formulaire. Cette class est nommé « Un DTO » (Data Transfert Objet). Les DTO sont de simples class PHP on l'encapsulation n'est pas nescessaire (les propriétés peuvent être public !).

Exemple de DTO pour une formulaire de recherche :

```php
/**
 * Cette classe contient les données du formulaire de recherche
 * des annonces
 */
class AdSearchCriteria
{
    /**
     * Contient le texte de recherche
     */
    public ?string $searchText = null;

    /**
     * Contient la champs du trie
     */
    public string $orderBy = 'createdAt';

    /**
     * Contient la direction du trie
     */
    public string $direction = 'DESC';
}
```

> ATTENTION
> Les DTO se range dans le dossier : « src/DTO » !

## Générer le formulaire à partir du DTO

Pour générer un formulaire de recherche il faut utiliser la commande :

```bash
# sans docker
symfony console make:form <nomDuFormulaire>
# avec docker
bin/sf console ma:fo <nomDuFormulaire>
```

**ATTENTION** : Il vous sera demandé l'entité ou la data class du formulaire. Dans le cas d'un formulaire de recherche ce n'est pas une entité, il faut spécifier le nom complet de la class :

ex :

```
> \App\DTO\<NomDeLaClassDTO>
```

**ATTENTION** les formulaires de recherche doivent utiliser la method HTTP **GET** et n'ont pas de token de sécurité CSRF. Pour cela rien de plus simple :

```php
public function configureOptions(OptionsResolver $resolver): void
{
    $resolver->setDefaults([
        'data_class' => AdSearchCriteria::class,
        'method' => 'GET',
        'csrf_protection' => false,
    ]);
}
```

**BONUS** : Vous pouvez désactiver le prefix du formulaire :

```php
public function getBlockPrefix(): string
{
    return '';
}
```
