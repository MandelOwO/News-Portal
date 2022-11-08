<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

$category = false;
if (!empty($_GET['id'])) {
    $category = $categoryRepo->getById($_GET['id']);
}

?>

<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLE LINKS -->
    <?php $tool->importBootstrap(); ?>
    <link rel="stylesheet" href="../source/styles/style.css">

    <title>Neko admin | category editor</title>
</head>
<body>


<?php
$page = 'admin';
require_once '../source/pages/navbar.php';
?>

<main class="editor-page">

    <section class="page-header white-font">
        <h1>
            <?php if ($category) { ?>
                Upravit kategorii "<?= $category['name'] ?>"
            <?php } else { ?>
                Přidat kategorii
            <?php } ?>
        </h1>
        <a href="categories.php">
            <button type="button" class="btn btn-bd-primary">Zpět na výpis</button>
        </a>
    </section>

    <section class="editor">
        <form action="" method="post">
            <label for="name">Název: </label>
            <input type="text" name="name" id="name" class="text-input"
                   value="<?= $category ? $category['name'] : '' ?>">
            <button type="submit" class="btn btn-bd-primary btn-save">Uložit</button>
        </form>
    </section>
</main>


</body>
</html>
