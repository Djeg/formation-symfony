# Mettre en place un design

En utisant, les couleurs, la police et la disposition. Votre rôle est de mettre un petit design.

## 1. Créer une feuille de style

Créer votre propre feuille de style `css` dans le dossier `public` (par éxemple: `public/style.css`).

Vous pouvez y placer le code suivant :

```css
html,
body {
  margin: 0;
  padding: 0;
}
```

Insérer cette feuille de style dans votre template `base.html.twig` :

```html
<link rel="stylesheet" href="/style.css" />
```

## 2. Mettre en place des couleurs

Vous pouvez, en utilisant votre fichier css, créer des variables pour vos couleurs :

```css
:root {
  --color-platinium: #e6e8e6;
  --color-gray: #ced0ce;
  --color-pink: #ffd6d7;
  --color-black: #3f403f;
  --color-cafe: #4b2f1b;
}

html,
body {
  background-color: var(--color-platinium);
}
```

## 3. Mettre en place les polices d'écritures

Pour utiliser des polices d'écriture de [google font](https://fonts.google.com/) il faut
tout d'abord rajouter des balises `link` dans votre template : `base.html.twig`

```html
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Lobster&family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
  rel="stylesheet"
/>
```

Ensuite, pour utiliser l'une de ces polices dans votre css :

```css
html,
body {
  font-family: "Noto Sans", sans-serif;
}

h1 {
  font-family: "Lobster", cursive;
}
```

Il éxiste une police d'écriture très célébre pour afficher des icones : [fontawesome](https://fontawesome.com/search?o=r&m=free)

Pour installer la police d'écriture, rien de plus simple, placer la balise `link` suivante dans votre template `base.html.twig`

```html
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
  integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
```

Pour utiliser et afficher un icone, sélectionner sur le site de font-awesome, l'icone voulue et copié collé
son code :

```html
<i class="fa-solid fa-building-columns"></i>
```

### 4. Mettre en place la disposition

Dans les pages du controller `AdminBookController`, en utilisant des classes css, mettre en place la disposition inspiré du design figma :

[https://www.figma.com/file/3bC5Zl4GlH3EWe36IGVU4Z/LookBook?node-id=0%3A1&t=DU9qJHz41jPk0Giz-1](https://www.figma.com/file/3bC5Zl4GlH3EWe36IGVU4Z/LookBook?node-id=0%3A1&t=DU9qJHz41jPk0Giz-1)

Il faudra, grâce à des liens, pouvoir naviguer !
