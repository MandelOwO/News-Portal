<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$articleRepo = new ArticleRepository($db);
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

$article = $articleRepo->getArticleById($_GET['article_id']);

if (empty($_GET['article_id']) || $article == null) {
    header('Location: ../index.php');
}


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

    <link rel="stylesheet" href="../source/styles/style.css">

    <title>Neko news | <?= $article['title'] ?> </title>
</head>


<body>

<?php
$page = 'home';
require_once '../source/pages/navbar.php';
?>


<main>
    <section>
        <article>
            <div class="article-title">
                <h1><?= $article['title'] ?></h1>
                <small>
                    <?= $tool->convertDate($article['created_at']); ?>
                    <a href="../author/articles.php?author_id=<?= $article['author_id'] ?>"><?= $article['name'] ?> <?= $article['surname'] ?></a>
                </small> <br>
                <small>
                    <?= $categoryRepo->writeCategories($article['id']) ?>
                </small>
            </div>

            <div class="article-text">
                <div class="article-perex">
                    <i> <?= $article['perex'] ?></i>
                </div>
                <div class="article-image">
                    <img src="<?= $article['image'] ?>" alt="">
                </div>
                <div class="article-body">
                    <?= $article['text'] ?>
                </div>
            </div>
        </article>
    </section>


</main>

<!-- GO TO TOP BTN -->
<div id="ToTopBtn"></div>
<script>
    $(function () {
        $("#ToTopBtn").load("../source/pages/ToTopBtn.html");
    });
</script>
</body>
</html>
