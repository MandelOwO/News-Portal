<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

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
    </section>

    <div class="table-container">
        <table class="rwd-table">
            <tr>
                <th>Název</th>
                <th>Počet článků</th>
                <th>Akce</th>
            </tr>

            <tr>
                <td data-th="Název">Star Wars</td>
                <td data-th="Počet článků">Adventure, Sci-fi</td>
                <td data-th="Akce">1977</td>
            </tr>

        </table>
    </div>

</main>


</body>
</html>
