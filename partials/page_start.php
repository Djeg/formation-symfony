<!DOCTYPE html>
<html lang="fr">

<head>
    <title>PizzaShop - <?= isset($title) ? $title : 'Votre pizzeria' ?></title>
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
