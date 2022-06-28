<?php
// Récupération des données du formulaire
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$repeatedPassword = isset($_POST['repeatedPassword']) ? $_POST['repeatedPassword'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$zipCode = isset($_POST['zipCode']) ? $_POST['zipCode'] : '';
$street = isset($_POST['street']) ? $_POST['street'] : '';
$supplement = isset($_POST['supplement']) ? $_POST['supplement'] : '';

// Création d'un tableaux de récéptacle à erreur
$errors = [
    'firstname' => '',
    'lastname' => '',
    'email' => '',
    'password' => '',
    'repeatedPassword' => '',
    'phone' => '',
    'city' => '',
    'zipCode' => '',
    'street' => '',
    'supplement' => '',
];

// On test si le formulaire à bien était envoyé :
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On valide le nom
    if (!$firstname || strlen($firstname) < 2) {
        $errors['firstname'] = 'Vous devez spécifier un prénom de 2 caractères minimum';
    }

    // On valide le prénom
    if (!$lastname || strlen($lastname) < 2) {
        $errors['lastname'] = 'Vous devez spécifier un nom de 2 caractères minimum';
    }

    // On valide l'email
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Votre email n\'est pas valide';
    }

    // On valide le mot de passe
    if (!$password || strlen($password) < 6) {
        $errors['password'] = 'Votre mot de passe est trop court, 6 caractères minimum';
    }

    // On valide le mot de passe
    if (!$repeatedPassword || strlen($repeatedPassword) < 6) {
        $errors['repeatedPassword'] = 'Votre mot de passe est trop court, 6 caractères minimum';
    }

    // On valie les deux mots de passe
    if ($password !== $repeatedPassword) {
        $errors['repeatedPassword'] = 'Vos deux mot de passes doivent correspondre';
    }

    // On test si il n'y a pas d'erreur
    $hasError = false;
    foreach ($errors as $key => $value) {
        if ($value) {
            $hasError = true;
            break;
        }
    }

    if (!$hasError) {
        // Enregistrement en base de données !
    }
}

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
    <link rel="stylesheet" href="/css/style.css" />
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
                    <input type="text" name="lastname" id="lastname" value="<?= $lastname ?>">
                </div>
                <? if ($errors['lastname']) : ?>
                    <p class="error"><?= $errors['lastname'] ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="firstname">Votre prénom :</label>
                    <input type="text" name="firstname" id="firstname" value="<?= $firstname ?>">
                </div>
                <? if ($errors['firstname']) : ?>
                    <p class="error"><?= $errors['firstname'] ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="email">Votre email :</label>
                    <input type="email" name="email" id="email" value="<?= $email ?>">
                </div>
                <? if ($errors['email']) : ?>
                    <p class="error"><?= $errors['email'] ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="password">Votre mot de passe :</label>
                    <input type="password" name="password" id="password" value="<?= $password ?>">
                </div>
                <? if ($errors['password']) : ?>
                    <p class="error"><?= $errors['password'] ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="repeatedPassword">Répéter votre mot de passe :</label>
                    <input type="password" name="repeatedPassword" id="repeatedPassword" value="<?= $repeatedPassword ?>">
                </div>
                <? if ($errors['repeatedPassword']) : ?>
                    <p class="error"><?= $errors['repeatedPassword'] ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="phone">Numéro de téléphone :</label>
                    <input type="text" name="phone" id="phone" value="<?= $phone ?>">
                </div>
                <? if ($errors['phone']) : ?>
                    <p class="error"><?= $errors['phone'] ?></p>
                <? endif ?>
                <h2>Votre adresse</h2>
                <div class="form-group">
                    <label for="city">Ville :</label>
                    <input type="text" name="city" id="city" value="<?= $city ?>">
                </div>
                <? if ($errors['city']) : ?>
                    <p class="error"><?= $errors['city'] ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="zipCode">Code postale :</label>
                    <input type="text" name="zipCode" id="zipCode" value="<?= $zipCode ?>">
                </div>
                <? if ($errors['zipCode']) : ?>
                    <p class="error"><?= $errors['zipCode'] ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="street">N° et nom de la voie :</label>
                    <input type="text" name="street" id="street" value="<?= $street ?>">
                </div>
                <? if ($errors['street']) : ?>
                    <p class="error"><?= $errors['street'] ?></p>
                <? endif ?>
                <div class="form-group">
                    <label for="supplement">Complément d'adresse :</label>
                    <textarea name="supplement" id="supplement"><?= $supplement ?></textarea>
                </div>
                <? if ($errors['supplement']) : ?>
                    <p class="error"><?= $errors['supplement'] ?></p>
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
