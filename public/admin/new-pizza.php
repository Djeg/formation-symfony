<?

// Inclusion de composer
require_once '../../vendor/autoload.php';

use App\Controller\NewPizzaController;

// Création et lancement du controller
$view = (new NewPizzaController())->start();
?>

<? $title = 'Nouvelle Pizza'; ?>
<? include '../../partials/page_start.php'; ?>

<div class="content">
    <h1>Nouvelle Pizza</h1>

    <!-- Formulaire d'inscription -->
    <form class="form-vertical" method="POST">
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" value="<?= $view->pizza->name ?>">
        </div>
        <? if ($view->error->name) : ?>
            <p class="error"><?= $view->error->name ?></p>
        <? endif ?>
        <div class="form-group">
            <label for="price">Prix :</label>
            <input type="number" name="price" id="price" min="1.00" step="0.01" max="30.99" value="<?= $view->pizza->price ?>">
        </div>
        <? if ($view->error->price) : ?>
            <p class="error"><?= $view->error->price ?></p>
        <? endif ?>
        <div class="form-group">
            <label for="imageUrl">Url de l'mimage :</label>
            <input type="url" name="imageUrl" id="imageUrl" value="<?= $view->pizza->imageUrl ?>">
        </div>
        <? if ($view->error->imageUrl) : ?>
            <p class="error"><?= $view->error->imageUrl ?></p>
        <? endif ?>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" id="description"><?= $view->pizza->description ?></textarea>
        </div>
        <? if ($view->error->description) : ?>
            <p class="error"><?= $view->error->description ?></p>
        <? endif ?>
        <div class="btn-group">
            <button type="submit">
                <i class="fa-solid fa-square-pen"></i>
                <span>Envoyer</span>
            </button>
        </div>
    </form>
</div>

<? include '../../partials/page_end.php'; ?>
