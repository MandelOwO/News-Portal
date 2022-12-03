<?php
session_start();

if (isset($_SESSION['user'])){
    header('Location: ../articles');
    die();
}

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();


$tool = new Tools();
$db = new Database();
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
    <script src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
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
            <form action="register-submit.php" method="post" class="login-form">
                <div>
                    <label for="mail">Email</label>
                    <input type="email" id="mail" name="mail" class="text-input input-login" required>
                </div>

                <div>
                    <label for="pass">Heslo</label>
                    <input type="password" id="pass" name="pass" class="text-input input-login" required>
                </div>

                <div>
                    <label for="name">Jméno</label>
                    <input type="text" id="name" name="name" class="text-input input-login" required>
                </div>

                <div>
                    <label for="surname">Příjmení</label>
                    <input type="text" id="surname" name="surname" class="text-input input-login" required>
                </div>

                <p class="login-error">
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'empty-field') { ?>
                        Prosím vyplňte všechna pole.
                    <?php } ?>
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'email-taken') { ?>
                        Pod tímto emailem je již zaregistrovaný jiný uživatel.
                    <?php } ?>
                </p>

                <p>Už máte účet?
                    <a href="login.php">Přihlásit</a>
                </p>

                <button type="submit" class="btn btn-bd-primary btn-save btn-login">Registrovat</button>
            </form>
        </article>
    </section>
</main>

</body>
</html>
