<?php

require_once 'App.php';
require_once 'tools/Tools.php';
App::init();

$db = new Database();
$articleRepo = new ArticleRepository($db);
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();


$articles = $articleRepo->getLastFiveArticles();

$menuCategorySource = $categoryRepo->getLastFiveCategories();
$menuAuthorSource = $authorRepo->getLastFiveAuthors();
?>

<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLE LINKS -->
    <?php $tool->importBootstrap(); ?>
    <link rel="stylesheet" href="source/style.css">

    <title>Neko news | Home</title>
</head>
<body>


<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="source/images/Logo-dark.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Zprávy</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Kategorie
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($menuCategorySource as $item) { ?>
                            <li>
                                <a class="dropdown-item"
                                   href="category/articles.php?category_id=<?= $item['category_id'] ?>"><?= $item['category_name'] ?>
                                </a>
                            </li>
                        <?php } ?>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="category">Všechny kategorie</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Autoři
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($menuAuthorSource as $item) { ?>
                            <li>
                                <a class="dropdown-item"
                                   href="category/articles.php?category_id=<?= $item['id'] ?>"><?= $item['name'] ?> <?= $item['surname'] ?>
                                </a>
                            </li>
                        <?php } ?>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="author">Všichni autoři</a></li>
                    </ul>
                </li>

            </ul>
            <form class="d-flex search" role="search">
                <input class="form-control me-2" type="search" placeholder="Vyhledat na webu" aria-label="Search"
                       name="search">
                <button class="btn btn-primary" type="submit">Vyhledat</button>
            </form>
        </div>
    </div>
</nav>

<!--
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
    <a href="">Administrace článků</a>
</li>
<li class="last-li">
    <a href="">Přidat článek</a>
</li>
    </menu>
    </header>
-->


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
