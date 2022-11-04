<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$articleRepo = new ArticleRepository($db);
$tool = new Tools();

$tableData = $articleRepo->getAllArticles();

?>

<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLE LINKS -->
    <?php $tool->importBootstrap(); ?>
    <link rel="stylesheet" href="../source/styles/rwd-table.css">
    <link rel="stylesheet" href="../source/styles/style.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <title>Neko admin | články</title>
</head>
<body>

<!-- NAVBAR -->
<?php
$page = 'admin';
require_once '../source/pages/navbar.php';
?>

<main id="article-admin-table">
    <section class="page-header white-font">
        <h1>Administrace článků</h1>
    </section>

    <div class="table-container ">
        <table class="rwd-table .article-admin-table">
            <tr>
                <th>Datum vytvoření</th>
                <th>Titulek</th>
                <th>Autor</th>
                <th>Kategorie</th>
                <th>Zveřejněný</th>
                <th>Akce</th>
            </tr>

            <?php foreach ($tableData as $row) { ?>
                <tr>
                    <td data-th="Datum vytvoření"><?= $tool->convertDate($row['date']) ?></td>
                    <td data-th="Název"><?= $row['title'] ?></td>
                    <td data-th="Autor"><?= $row['author_name'] ?> <?= $row['author_surname'] ?></td>
                    <td data-th="Kategorie"><?= $categoryRepo->writeCategories($row['article_id']) ?></td>
                    <td data-th="Zveřejněný">x</td>
                    <td data-th="Akce" class="action-column">
                        <div class="btn-group btn-group-sm table-edit-buttons" role="group"
                             aria-label="Small button group">
                            <a href="delete.php?from=articles&id=<?= $row['article_id'] ?>"
                               type="button" class="btn btn-outline-dark btn-delete">
                                <img src="../source/icons/trash.svg" alt="smazat" class="table-icon">
                            </a>
                            <a href="" type="button" class="btn btn-outline-dark btn-edit "> <!-- TODO link -->
                                <img src="../source/icons/pen.svg" alt="upravit" class="table-icon">
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</main>
</body>
</html>
