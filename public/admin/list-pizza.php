<?

// Inclusion de composer
require_once '../../vendor/autoload.php';

use App\Controller\ListPizzaController;

// Création et lancement du controller
$view = (new ListPizzaController())->start();
?>

<? include '../../partials/page_start.php'; ?>

<div class="content">
    <h1>Liste des pizzas</h1>

    <div class="pizza-list">
        <? foreach ($view->list as $pizza) : ?>
            <div class="pizza-card">
                <p class="title"><?= $pizza->name ?></p>
                <p class="description"><?= $pizza->description ?></p>
                <div class="btn-group">
                    <a href="#modifier" class="btn">
                        <i class="fa-solid fa-pen"></i>
                        <span>Modifier</span>
                    </a>
                    <a href="#supprimer" class="btn red">
                        <i class="fa-solid fa-trash"></i>
                        <span>Supprimer</span>
                    </a>
                </div>
                <div class="background">
                    <div class="frame"></div>
                    <img src="<?= $pizza->imageUrl ?>" class="img" />
                </div>
            </div>
        <? endforeach ?>
    </div>
</div>


<? include '../../partials/page_end.php'; ?>
