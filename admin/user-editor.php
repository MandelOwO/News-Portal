<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$userRepo = new UserRepository($db);
$tool = new Tools();

/* LOAD */
$user = false;
if (!empty($_GET['id'])) {
    $user = $userRepo->getById($_GET['id']);
}

/* SAVE */

if (isset($_POST) && !empty($_POST)) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $mail = trim($_POST['mail']);
    $role = $_POST['role'];
    $active = $_POST['active'];

    if (!empty($name) && !empty($surname) && !empty($mail)) {
        if (!$user) {
            $userRepo->insert($mail, $name, $surname, $role, $active);
            header('Location: users.php');
        } else {
            $userRepo->update($user['id'], $mail, $name, $surname, $role, $active);
            header('Location: users.php');
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
                <option value="" hidden >-- Vyberte roli --</option>
                <option value="user" <?= $user['role']=='user' ? 'selected' : '' ?>>Uživatel</option>
                <option value="editor" <?= $user['role']=='editor' ? 'selected' : '' ?>>Editor</option>
                <option value="admin" <?= $user['role']=='admin' ? 'selected' : '' ?>>Administrátor</option>
            </select>

            <label for="active">Aktivní: </label>
            <label class="container category-label" for="published">
                <input type="checkbox" name="active" id="active"
                       value="1" <?= $user && $user['active'] ? 'checked' : '' ?>>
                <span class="checkmark"></span>
            </label>

            <button type="submit" class="btn btn-bd-primary btn-save">Uložit</button>
        </form>
    </section>
</main>

</body>
</html>
