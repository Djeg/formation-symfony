# Les CORS et les api REST

Il éxiste un sécurité sur la plupart des appareil d'aujourdhui (IPhone, PS5, Android, Site Internet, Navigateur ....) :

**Cross Origin Resource Sharing**

Le principe est simple :

Si je suis sur un site `google.fr`, alors je n'ai le droit de faire des requêtes **QUE** sur le site `google.fr`.

## Mettre en place les CORS

Il éxiste cependant la possibilité d'autoriser certains sites à communique avec nous. Ce sont les CORS ! Notre API Rest symfony pourrais par éxemple autoriser les requête de la part de `tf1.fr`.

Afin de mettre en place ces autorisation, il nous faut installer un bundle :

```bash
# sans docker
symfony composer require nelmio/cors-bundle
# avec docker
bin/sf composer req nelmio/cors-bundle
```

> Vous retrouverez sa documentation [ici](https://github.com/nelmio/NelmioCorsBundle)

## Configurer les cors

Une fois installer, une variable de configuration est présente dans le fichier `.env` :

```env
CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'
```

> C'est une expression régulière, vous pouvez ajouter des nom de domaine simplement :

```env
CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1|amazon|tf1|super-library)(:[0-9]+)?$'
```
