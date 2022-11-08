<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

$tableData = $authorRepo->getAuthorTableData()

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
        <h1>Administrace autorů</h1>
        <a href="author-editor.php">
            <button type="button" class="btn btn-bd-primary">Přidat autora</button>
        </a>
    </section>

    <div class="table-container">
        <table class="rwd-table">
            <tr>
                <th>Příjmení</th>
                <th>Jméno</th>
                <th>Počet článků</th>
                <th>Akce</th>
            </tr>

            <?php foreach ($tableData as $row) { ?>
                <tr>
                    <td data-th="Příjmení"><?= $row['surname'] ?></td>
                    <td data-th="Jméno"><?= $row['name'] ?></td>
                    <td data-th="Počet článků"><?= $row['article_count'] ?></td>
                    <td data-th="Akce" class="action-column">
                        <div class="btn-group btn-group-sm table-edit-buttons" role="group"
                             aria-label="Small button group">
                            <a href="delete.php?from=authors&id=<?= $row['id'] ?>"
                               type="button" class="btn btn-outline-dark btn-delete"
                                <?php if ($row['article_count'] > 0) { ?>
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                <?php } ?>
                            >
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Autor nemůže být smazán</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Autora nelze smazat, protože jsou pod jeho jménem napsány nějaké články. Nejprve odstraňte články od
                tohoto autora.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>


</body>
</html>
