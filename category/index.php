<?php


require_once 'tools/App.php';
require_once 'tools/Tools.php';
App::init();

$db = new Database();
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

$categoryRepo->getAll(); // TODO
?>

<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLE LINKS -->
    <link rel="stylesheet" href="../source/style.css">

    <title>Kategorie</title>
</head>
<body>

<header>
    <div class="header-logo">
        <img src="../source/images/Logo.png" alt="">
    </div>
    <menu>
        <li >
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
</main>

</body>
</html>
