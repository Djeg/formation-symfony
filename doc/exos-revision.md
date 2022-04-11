# Exercice Révision

## 1. Doctrine

Générer les entités suivantes :

```
Book:
	- title (string)
	- description (text)
	- createdAt (datetime)
	- updatedAt (datetime)
	- price (float)

Author:
	- name (string)
	- description (text)
	- createdAt (datetime)
	- updatedAt (datetime)
```

Graçe à la commande `symfony console make:entity Book`, relier
le `Book` à l'`Author` en utilisant une relation OneToMany (le livre
possède un auteur, et l'auteur posséde plusieurs livres).
