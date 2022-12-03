<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();


$tool = new Tools();
$db = new Database();
$articleRepo = new ArticleRepository($db);
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLE LINKS -->
    <?php $tool->importBootstrap(); ?>
    <link rel="stylesheet" href="../source/styles/style.css">

    <title>Neko news | Přihlášení</title>
</head>
<body>

<!-- NAVBAR -->
<?php
$page = 'login';
require_once '../source/pages/navbar.php';
?>

<main>
    <section>
        <article class="login-window">
            <form action="" method="post" class="login-form">
                <div>
                    <label for="mail">Email</label>
                    <input type="text" id="mail" name="mail" class="text-input input-login">
                </div>

                <div>
                    <label for="pass">Heslo</label>
                    <input type="password" id="pass" name="pass" class="text-input input-login">
                </div>

                <p class="login-error">
                    Nesprávný email nebo heslo.
                </p>

                <p>Nemáte účet?
                    <a href="register.php">Registrovat</a>
                </p>

                <button type="submit" class="btn btn-bd-primary btn-save btn-login">Přihlásit</button>
            </form>
        </article>
    </section>
</main>

</body>
</html>
