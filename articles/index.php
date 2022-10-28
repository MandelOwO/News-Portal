<?php

require_once '../App.php';
require_once '../tools/Tools.php';
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
    <script src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <?php $tool->importBootstrap(); ?>
    <link rel="stylesheet" href="../source/style.css">

    <title>Neko news | Home</title>
</head>


<body>


<script>
    $(function () {
        $("#includedContent").load("../source/pages/navbar.php?page=home");
    });
</script>
<div id="includedContent"></div>


<main>
    <section class="page-header white-font">
        <h1>Články</h1>
        <h3><i>Nejnovější zprávy z IT</i></h3>
    </section>

    <section>
        <?php foreach ($articles as $article) { ?>
            <article>
                <div class="article-title">
                    <h2><a href="article.php?article_id=<?= $article['id'] ?>"><?= $article['title'] ?></a></h2>
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
                    <a href="article.php?article_id=<?= $article['id'] ?>">
                        <div><img src="../source/icons/arrow-alt-right.svg" alt=""></div>
                        <div>Číst dále</div>
                    </a>
                </div>
            </article>
        <?php } ?>
    </section>
</main>

</body>
</html>
