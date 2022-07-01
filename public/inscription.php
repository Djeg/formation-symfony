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

<? $title = 'Inscription'; ?>
<? include '../partials/page_start.php'; ?>

<div class="content">
    <h1>Inscription</h1>

    <!-- Formulaire d'inscription -->
    <form class="form-vertical" method="POST">
        <h2>Vos informations personelles</h2>
        <div class="form-group">
            <label for="lastname">Votre nom :</label>
            <input type="text" name="lastname" id="lastname" value="<?= $view->newUser->lastname ?>">
        </div>
        <? if (!empty($view->errors->lastname)) : ?>
            <? foreach ($view->errors->lastname as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <div class="form-group">
            <label for="firstname">Votre prénom :</label>
            <input type="text" name="firstname" id="firstname" value="<?= $view->newUser->firstname ?>">
        </div>
        <? if (!empty($view->errors->firstname)) : ?>
            <? foreach ($view->errors->firstname as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <div class="form-group">
            <label for="email">Votre email :</label>
            <input type="email" name="email" id="email" value="<?= $view->newUser->email ?>">
        </div>
        <? if (!empty($view->errors->email)) : ?>
            <? foreach ($view->errors->email as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <div class="form-group">
            <label for="password">Votre mot de passe :</label>
            <input type="password" name="password" id="password" value="<?= $view->newUser->password ?>">
        </div>
        <? if (!empty($view->errors->password)) : ?>
            <? foreach ($view->errors->password as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <div class="form-group">
            <label for="repeatedPassword">Répéter votre mot de passe :</label>
            <input type="password" name="repeatedPassword" id="repeatedPassword" value="<?= $view->newUser->repeatedPassword ?>">
        </div>
        <? if (!empty($view->errors->repeatedPassword)) : ?>
            <? foreach ($view->errors->repeatedPassword as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <div class="form-group">
            <label for="phone">Numéro de téléphone :</label>
            <input type="text" name="phone" id="phone" value="<?= $view->newUser->phone ?>">
        </div>
        <? if (!empty($view->errors->phone)) : ?>
            <? foreach ($view->errors->phone as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <h2>Votre adresse</h2>
        <div class="form-group">
            <label for="city">Ville :</label>
            <input type="text" name="city" id="city" value="<?= $view->newUser->city ?>">
        </div>
        <? if (!empty($view->errors->city)) : ?>
            <? foreach ($view->errors->city as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <div class="form-group">
            <label for="zipCode">Code postale :</label>
            <input type="text" name="zipCode" id="zipCode" value="<?= $view->newUser->zipCode ?>">
        </div>
        <? if (!empty($view->errors->zipCode)) : ?>
            <? foreach ($view->errors->zipCode as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <div class="form-group">
            <label for="street">N° et nom de la voie :</label>
            <input type="text" name="street" id="street" value="<?= $view->newUser->street ?>">
        </div>
        <? if (!empty($view->errors->street)) : ?>
            <? foreach ($view->errors->street as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <div class="form-group">
            <label for="supplement">Complément d'adresse :</label>
            <textarea name="supplement" id="supplement"><?= $view->newUser->supplement ?></textarea>
        </div>
        <? if (!empty($view->errors->supplement)) : ?>
            <? foreach ($view->errors->supplement as $error) : ?>
                <p class="error"><?= $error ?></p>
            <? endforeach ?>
        <? endif ?>
        <div class="btn-group">
            <button type="submit">
                <i class="fa-solid fa-square-pen"></i>
                <span>S'inscrire</span>
            </button>
        </div>
    </form>
</div>

<? include '../partials/page_end.php'; ?>
