<?php


require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$tool = new Tools();

$categoryRepo = new CategoryRepository($db);

$firstLetters = $categoryRepo->getCategoriesFirstLetter();


?>

<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLE LINKS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../source/style.css">


    <title>Kategorie</title>
</head>
<body>

<header>
    <div class="header-logo">
        <img src="../source/images/Logo.png" alt="">
    </div>
    <menu>
        <li>
            <a href="../">Zprávy</a>
        </li>
        <li class="current-page">
            <a href="#">Kategorie</a>
        </li>
        <li>
            <a href="../author">Autoři</a>
        </li>
        <li>
            <a href="">Administrace článků</a> <!-- TODO link -->
        </li>
        <li class="last-li">
            <a href="">Přidat článek</a> <!-- TODO link -->
        </li>
    </menu>
</header>

<main>
    <section class="page-header white-font">
        <h1>Kategorie</h1>
    </section>

    <section class="categories-list">

    </section>
</main>

</body>
</html>
