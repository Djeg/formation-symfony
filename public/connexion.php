<?

// Inclusion de composer
require_once '../vendor/autoload.php';

use App\Controller\ConnexionController;

// Création du controller
$controller = new ConnexionController();

// Récupération des données du controller
$view = $controller->start();
?>

<? $title = 'Connexion'; ?>
<? include '../partials/page_start.php'; ?>

<div class="content">
    <h1>Connexion</h1>

    <!-- Formulaire d'inscription -->
    <form class="form-vertical" method="POST">
        <div class="form-group">
            <label for="email">Votre email :</label>
            <input type="email" name="email" id="email" value="<?= $view->credential->email ?>">
        </div>
        <? if ($view->error->email) : ?>
            <p class="error"><?= $view->error->email ?></p>
        <? endif ?>
        <div class="form-group">
            <label for="password">Votre mot de passe :</label>
            <input type="password" name="password" id="password" value="<?= $view->credential->password ?>">
        </div>
        <? if ($view->error->password) : ?>
            <p class="error"><?= $view->error->password ?></p>
        <? endif ?>
        <div class="btn-group">
            <button type="submit">
                <i class="fa-solid fa-square-pen"></i>
                <span>Se connécter</span>
            </button>
        </div>
    </form>
</div>

<? include '../partials/page_end.php'; ?>
