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
    <script src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <?php $tool->importBootstrap(); ?>

    <link rel="stylesheet" href="../source/style.css">


    <title>Neko news | Kategorie</title>
</head>


<body>


<script>
    $(function () {
        $("#includedContent").load("../source/pages/navbar.php?page=category");
    });
</script>
<div id="includedContent"></div>


<main>
    <section class="page-header white-font">
        <h1>Kategorie</h1>
    </section>

    <section class="categories-list">
        <?php foreach ($firstLetters as $firstLetter) { ?>
            <div class="category-group">
                <h2><?= $firstLetter['first_letter'] ?></h2>
                <?php foreach ($categoryRepo->getCategoriesByLetter($firstLetter['first_letter']) as $item) { ?>
                    <ul>
                        <li>
                            <a href="articles.php?category_id=<?= $item['id'] ?>"><?= $item['name'] ?></a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        <?php } ?>

    </section>
</main>

</body>
</html>
