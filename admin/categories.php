<?php

require_once '../tools/categories-script.php';

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

    <title>Neko admin | kategorie</title>
</head>
<body>

<!-- NAVBAR -->
<?php
$page = 'admin';
require_once '../source/pages/navbar.php';
?>

<main>
    <section class="page-header white-font">
        <h1>Administrace kategorií</h1>
        <a href="category-editor.php">
            <button type="button" class="btn btn-bd-primary">Přidat kategorii</button>
        </a>
    </section>

    <section class="table-container">
        <table class="rwd-table">
            <tr>
                <th>Název</th>
                <th>Počet článků</th>
                <th>Akce</th>
            </tr>

            <?php foreach ($tableData as $row) { ?>
                <tr>
                    <td data-th="Název: "><?= $row['name'] ?></td>
                    <td data-th="Poč. článků: "><?= $row['article_count'] ?></td>
                    <td class="action-column">
                        <div class="btn-group btn-group-sm table-edit-buttons" role="group"
                             aria-label="Small button group">
                            <a href="delete.php?from=categories&id=<?= $row['id'] ?>"
                               type="button" class="btn btn-outline-dark btn-delete"
                                <?php if ($row['article_count'] > 0) { ?>
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                <?php } ?>
                            >
                                <img src="../source/icons/trash.svg" alt="smazat" class="table-icon">
                            </a>
                            <a href="category-editor.php?id=<?= $row['id'] ?>" type="button"
                               class="btn btn-outline-dark btn-edit ">
                                <img src="../source/icons/pen.svg" alt="upravit" class="table-icon">
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kategorie nemůže být smazána</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Kategorii nelze smazat, protože k ní jsou přiřazeny články. Nejprve odstraňte články z této kategorie.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>


</body>
</html>
