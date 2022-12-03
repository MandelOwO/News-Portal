<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$userRepo = new UserRepository($db);
$tool = new Tools();

$tableData = $userRepo->getAll();

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

    <title>Neko admin | Uživatelé</title>
</head>
<body>

<!-- NAVBAR -->
<?php
$page = 'admin';
require_once '../source/pages/navbar.php';
?>

<main>
    <section class="page-header white-font">
        <h1>Administrace uživatelů</h1>
    </section>

    <div class="table-container">
        <table class="rwd-table">
            <tr>
                <th>Příjmení</th>
                <th>Jméno</th>
                <th>Email</th>
                <th>Role</th>
                <th>Stav</th>
                <th>Akce</th>
            </tr>

            <?php foreach ($tableData as $row) { ?>
                <tr>
                    <td data-th="Příjmení"><?= $row['surname'] ?></td>
                    <td data-th="Jméno"><?= $row['name'] ?></td>
                    <td data-th="Email"><?= $row['mail'] ?></td>
                    <td data-th="Role"><?= $row['role'] ?></td>
                    <td data-th="Zveřejněný">
                        <?php if ($row['active']) { ?>
                            <img src="../source/icons/check.svg" alt="ano" height="25">
                        <?php } else { ?>
                            <img src="../source/icons/times.svg" alt="ne" height="30">
                        <?php } ?>
                    </td>
                    <td data-th="Akce" class="action-column">
                        <div class="btn-group btn-group-sm table-edit-buttons" role="group"
                             aria-label="Small button group">
                            <a href="delete.php?from=users&id=<?= $row['id'] ?>"
                               type="button" class="btn btn-outline-dark btn-delete"
                            >
                                <img src="../source/icons/trash.svg" alt="smazat" class="table-icon">
                            </a>
                            <a href="user-editor.php?id=<?= $row['id'] ?>" type="button"
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
</body>
</html>
