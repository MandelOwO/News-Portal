<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$tool = new Tools();

$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);

$authors = $authorRepo->getAll();
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

    <title>Neko news | Autoři</title>
</head>


<body>

<?php
$page = 'author';
require_once '../source/pages/navbar.php';
?>


<main>
    <section class="page-header white-font">
        <h1>Naši autoři</h1>
    </section>

    <section class="author-list">
        <ul class="category-group">
            <?php foreach ($authors as $author) { ?>
                <li>
                    <a href="articles.php?author_id=<?= $author['id'] ?>">
                        <img src="<?= $author['profile_photo'] ?>" alt="">
                        <?= $author['name'] ?>
                        <?= $author['surname'] ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
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
