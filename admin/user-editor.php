<?php

require_once '../tools/user-editor-script.php';

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
            <?php if ($user) { ?>
                Upravit uživatele
            <?php } else { ?>
                Přidat uživatele
            <?php } ?>
        </h1>
        <a href="users.php">
            <button type="button" class="btn btn-bd-primary">Zpět na výpis</button>
        </a>
    </section>

    <section class="editor">
        <form action="" method="post">

            <label for="name">Jméno: </label>
            <input type="text" name="name" id="name" class="text-input"
                   value="<?= $user ? $user['name'] : '' ?>">

            <label for="surname">Příjmení: </label>
            <input type="text" name="surname" id="surname" class="text-input"
                   value="<?= $user ? $user['surname'] : '' ?>">

            <label for="mail">Email: </label>
            <input type="email" name="mail" id="mail" class="text-input"
                   value="<?= $user ? $user['mail'] : '' ?>">

            <label for="role">Role: </label>
            <select name="role" id="role" class="text-input">
                <option value="" hidden>-- Vyberte roli --</option>
                <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>Uživatel</option>
                <option value="editor" <?= $user['role'] == 'editor' ? 'selected' : '' ?>>Editor</option>
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Administrátor</option>
            </select>

            <label for="author">Autor: </label>
            <select name="author" id="author" class="text-input">
                <option value="" hidden>-- Vyberte Autora --</option>
                <option value="">--Žádný--</option>

                <?php foreach ($authors as $author) { ?>
                    <option value="<?= $author['id'] ?>" <?= $user['author_id'] == $author['id'] ? 'selected' : '' ?>> <?= $author['surname'] ?> <?= $author['name'] ?> </option>
                <?php } ?>

            </select>

            <label for="active">Aktivní: </label>
            <label class="container category-label" for="published">
                <input type="checkbox" name="active" id="active"
                       value="1" <?= $user && $user['active'] ? 'checked' : '' ?>>
                <span class="checkmark"></span>
            </label>

            <button type="submit" class="btn btn-bd-primary btn-save ">Uložit</button>

            <p class="login-error">
                <?php if ($error == 1){ ?>
                    Vybrali jste účet typu editor. Prosím přiřaďte odpovídající záznam autora k tomuto účtu.
                <?php } else if ($error == 2){ ?>
                    Autor smí být přiřazen pouze k účtu editora.
                <?php } else if($error == 3){ ?>
                    Tento autor už je přiřazen k jinému účtu.
                <?php } ?>
            </p>
        </form>
    </section>
</main>

</body>
</html>
