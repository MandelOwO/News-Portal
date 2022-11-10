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
    <!--    <script src="../source/scripts/article-modal.js"></script> -->

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
        <a href="article-editor.php?id=0">
            <button type="button" class="btn btn-bd-primary">Přidat článek</button>
        </a>
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
                    <td data-th="Dat. vytvoř."><?= $tool->convertDate($row['date']) ?></td>
                    <td data-th="Název"><?= $row['title'] ?></td>
                    <td data-th="Autor"><?= $row['author_name'] ?> <?= $row['author_surname'] ?></td>
                    <td data-th="Kategorie"><?= $categoryRepo->writeCategories($row['article_id']) ?></td>
                    <td data-th="Zveřejněný">
                        <?php if ($row['published']) { ?>
                            <img src="../source/icons/check.svg" alt="ano" height="25">
                        <?php } else { ?>
                            <img src="../source/icons/times.svg" alt="ne" height="30">
                        <?php } ?>
                    </td>
                    <td data-th="Akce" class="action-column">
                        <div class="btn-group btn-group-sm table-edit-buttons" role="group"
                             aria-label="Small button group">
                            <a href="delete.php?from=articles&id=<?= $row['article_id'] ?>"
                               type="button" class="btn btn-outline-dark btn-delete">
                                <img src="../source/icons/trash.svg" alt="smazat" class="table-icon">
                            </a>
                            <!--
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                   data-bs-target="#exampleModal">
                               Launch demo modal
                            </button>
                            -->
                            <a href="article-editor.php?id=<?= $row['article_id'] ?>" type="button"
                               class="btn btn-outline-dark btn-edit ">
                                <img src="../source/icons/pen.svg" alt="upravit" class="table-icon">
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</main>

<!-- Modal
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


</body>

<script>
    $('#glassAnimalsSong').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var song = button.data('song')
        // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        $('#song').text(song);
    })
</script>
-->

</html>
