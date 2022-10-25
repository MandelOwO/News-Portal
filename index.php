<?php

require_once 'tools/App.php';
require_once 'tools/Tools.php';
App::init();

$db = new Database();
$articleRepo = new ArticleRepository($db);
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();


$articles = $articleRepo->getLastFiveArticles();

?>

<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLE LINKS -->
    <link rel="stylesheet" href="source/style.css">

    <title>Neko news | Home</title>
</head>
<body>

<header>
    <div class="header-logo">
        <img src="source/images/Logo.png" alt="">
    </div>
    <menu>
        <li class="current-page">
            <a href="#">Zprávy</a>
        </li>
        <li>
            <a href="category">Kategorie</a>
        </li>
        <li>
            <a href="author">Autoři</a>
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
        <h1>Články</h1>
        <h3><i>Nejnovější zprávy z IT</i></h3>
    </section>

    <section>
        <?php foreach ($articles as $article) { ?>
            <article>
                <div class="article-title">
                    <h2><a href=""><?= $article['title'] ?></a></h2> <!-- TODO link -->
                    <small>
                        <?= $tool->convertDate($article['created_at']); ?>
                        <a href=""><?= $article['name'] ?> <?= $article['surname'] ?></a> <!-- TODO link -->
                    </small> <br>
                    <small>
                        <?= $categoryRepo->writeCategories($article['id']) ?>
                    </small>
                </div>
                <p class="article-perex">
                    <?= $article['perex'] ?>
                </p>
                <div class="read-more">
                    <a href="">  <!-- TODO link -->
                        <div><img src="source/icons/arrow-alt-right.svg" alt=""></div>
                        <div>Číst dále</div>
                    </a>
                </div>
            </article>
        <?php } ?>
    </section>
</main>

</body>
</html>
