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

    <? foreach ($view->list as $pizza) : ?>
        <p><?= $pizza->name ?> (prix: <?= $pizza->price ?>)</p>
    <? endforeach ?>
</div>


<? include '../../partials/page_end.php'; ?>
