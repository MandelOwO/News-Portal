<?php

require_once '../tools/author-editor-script.php'

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
