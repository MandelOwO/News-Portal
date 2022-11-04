<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

?>


<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLE LINKS -->
    <?php $tool->importBootstrap(); ?>
    <link rel="stylesheet" href="../source/style.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <title>Neko news | Administrace</title>
</head>
<body>


<!-- NAVBAR -->
<?php
$page = 'admin';
require_once '../source/pages/navbar.php';
?>

<main>

    <nav class="admin-nav">
        <a href="">
            <button type="button" class="btn btn-bd-primary">Přidat článek</button>
        </a>
        <a href="">
            <button type="button" class="btn btn-bd-primary">Přidat kategorii</button>
        </a>
        <a href="">
            <button type="button" class="btn btn-bd-primary">Přidat autora</button>
        </a>


    </nav>

    <section class="white-fill">
        <div class="article-title">
            <h1>Dashboard comming soon...</h1>
        </div>
    </section>


</main>

<!-- GO TO TOP BTN -->
<div id="ToTopBtn"></div>
<script>
    $(function () {
        $("#ToTopBtn").load("../source/ToTopBtn.html");
    });
</script>
</body>
</html>
