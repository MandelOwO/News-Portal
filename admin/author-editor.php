<?php

require_once '../tools/access-admin-only.php';

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

/* LOAD */
$author = false;
if (!empty($_GET['id'])) {
    $author = $authorRepo->getById($_GET['id']);
}

/* SAVE */

if (isset($_POST) && !empty($_POST)) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $profile_photo = trim($_POST['photo']);

    if (!empty($name) && !empty($surname)) {
        if (!$author) {
            $authorRepo->insert($name, $surname, $profile_photo);
            header('Location: authors.php');
        } else {
            $authorRepo->update($author['id'], $name, $surname, $profile_photo);
            header('Location: authors.php');
        }
    }
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

    <title>Neko admin | author editor</title>
</head>
<body>


<?php
$page = 'admin';
require_once '../source/pages/navbar.php';
?>

<main class="editor-page">

    <section class="page-header white-font author-editor-header">
        <h1>
            <?php if ($author) { ?>

                Upravit autora <br>
                "<?= $author['name'] ?> <?= $author['surname'] ?>"
                <img src="<?= $author['profile_photo'] ?>" alt="" class="author-photo">

            <?php } else { ?>
                Přidat autora
                <img src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg"
                     alt="" class="author-photo">
            <?php } ?>
        </h1>
        <a href="authors.php">
            <button type="button" class="btn btn-bd-primary">Zpět na výpis</button>
        </a>
    </section>

    <section class="editor">
        <form action="" method="post">

            <label for="name">Jméno: </label>
            <input type="text" name="name" id="name" class="text-input"
                   value="<?= $author ? $author['name'] : '' ?>">

            <label for="surname">Příjmení: </label>
            <input type="text" name="surname" id="surname" class="text-input"
                   value="<?= $author ? $author['surname'] : '' ?>">

            <label for="photo">Fotka: </label>
            <input type="url" name="photo" id="photo" class="text-input"
                   value="<?= $author ? $author['profile_photo'] : 'https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg' ?>">

            <div class="photo-tooltip">
                <small>Vložte prosím odkaz na fotografii v poměru stran 1:1</small>
            </div>

            <!--
                        <a href="author-editor.php?action=load_photo" class="load-photo">
                            Načíst fotografii
                        </a>
            -->

            <button type="submit" class="btn btn-bd-primary btn-save">Uložit</button>
        </form>
    </section>
</main>

</body>
</html>
