<?php

// on inclut composer. Cela vas nous permettre d'utiliser
// les « use ». Ces use peuvent être importé et généré automatiquement
// par notre éditeur de code.
require_once './../vendor/autoload.php';

// Le use permet de faire référence à une classe,
// ici la class « InscriptionController » situé 
// dans l'espace de nom : "App\Controller".
// L'éspace de nom correspond au répertoire dans src.
use App\Controller\InscriptionController;

// Création du controller d'inscription
$controller = new InscriptionController();

// Démarage du controller d'inscription. Cette méthode
// nous retourne un Objet App\View\InscriptionView avec toutes
// les données nescessaire pour afficher le HTML
$view = $controller->start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>PizzaShop - Inscription</title>
    <!-- FONT AWESOME : Librairie CSS de gestion des icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- GOOGLE FONTS : Librairie CSS de gestion des polices, ici nous
         utiliserons la police "Lobster" ainsi que "Nunito" pour le text -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- NOTRE STYLE CSS -->
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <!-- Header de notre page -->
    <header>
        <nav>
            <div>
                <a href="#home">
                    <i class="fa-solid fa-house"></i>
                </a>
            </div>
            <div>
                <a href="#basket">
                    <i class="fa-solid fa-basket-shopping"></i>
                </a>
                <a href="#user">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
        </nav>
    </header>

    <!-- Le corps de notre page, la balise main -->
    <main>
        <div class="content">
            <h1>Inscription</h1>

            <!-- Formulaire d'inscription -->
            <form class="form-vertical" method="POST">
                <h2>Vos informations personelles</h2>
                <div class="form-group">
                    <label for="lastname">Votre nom :</label>
                    <input type="text" name="lastname" id="lastname" value="<?= $view->newUser->lastname ?>">
                </div>
                <? if ($view->errors->lastname) : ?>
                    <p class="error"><?= $view->errors->lastname ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="firstname">Votre prénom :</label>
                    <input type="text" name="firstname" id="firstname" value="<?= $view->newUser->firstname ?>">
                </div>
                <? if ($view->errors->firstname) : ?>
                    <p class="error"><?= $view->errors->firstname ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="email">Votre email :</label>
                    <input type="email" name="email" id="email" value="<?= $view->newUser->email ?>">
                </div>
                <? if ($view->errors->email) : ?>
                    <p class="error"><?= $view->errors->email ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="password">Votre mot de passe :</label>
                    <input type="password" name="password" id="password" value="<?= $view->password ?>">
                </div>
                <? if ($view->errors->password) : ?>
                    <p class="error"><?= $view->errors->password ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="repeatedPassword">Répéter votre mot de passe :</label>
                    <input type="password" name="repeatedPassword" id="repeatedPassword" value="<?= $view->newUser->repeatedPassword ?>">
                </div>
                <? if ($view->errors->repeatedPassword) : ?>
                    <p class="error"><?= $view->errors->repeatedPassword ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="phone">Numéro de téléphone :</label>
                    <input type="text" name="phone" id="phone" value="<?= $view->newUser->phone ?>">
                </div>
                <? if ($view->errors->phone) : ?>
                    <p class="error"><?= $view->errors->phone ?></p>
                <? endif ?>
                <h2>Votre adresse</h2>
                <div class="form-group">
                    <label for="city">Ville :</label>
                    <input type="text" name="city" id="city" value="<?= $view->newUser->city ?>">
                </div>
                <? if ($view->errors->city) : ?>
                    <p class="error"><?= $view->errors->city ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="zipCode">Code postale :</label>
                    <input type="text" name="zipCode" id="zipCode" value="<?= $view->newUser->zipCode ?>">
                </div>
                <? if ($view->errors->zipCode) : ?>
                    <p class="error"><?= $view->errors->zipCode ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="street">N° et nom de la voie :</label>
                    <input type="text" name="street" id="street" value="<?= $view->newUser->street ?>">
                </div>
                <? if ($view->errors->street) : ?>
                    <p class="error"><?= $view->errors->street ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="supplement">Complément d'adresse :</label>
                    <textarea name="supplement" id="supplement"><?= $view->newUser->supplement ?></textarea>
                </div>
                <? if ($view->errors->supplement) : ?>
                    <p class="error"><?= $view->errors->supplement ?></p>
                <? endif ?>
                <div class="btn-group">
                    <button type="submit">
                        <i class="fa-solid fa-square-pen"></i>
                        <span>S'inscrire</span>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- le pied de page, la balise footer -->
    <footer>
        <div class="footer-content">
            <div class="logo">PizzaShop</div>
            <nav class="sitemap">
                <p>Plan du site</p>
                <ul>
                    <li>Accueil</li>
                    <li>Contact</li>
                    <li>Rechercher</li>
                    <li>Contact</li>
                </ul>
            </nav>
        </div>
    </footer>
</body>

</html>
