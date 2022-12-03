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

    <!-- import jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
            <form action="login-submit.php" method="post" class="login-form">
                <div>
                    <label for="mail">Email</label>
                    <input type="text" id="mail" name="mail" class="text-input input-login" required>
                </div>

                <div>
                    <label for="pass">Heslo</label>
                    <input type="password" id="pass" name="pass" class="text-input input-login" required>
                </div>

                <p class="login-error">
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'empty-field') { ?>
                        Prosím vyplňte všechna pole.
                    <?php } else if (isset($_GET['error']) && $_GET['error'] == 'invalid-credentials'){ ?>
                        Nesprávný email nebo heslo.
                    <?php } else if (isset($_GET['error']) && $_GET['error'] == 'inactive-account'){ ?>
                        Váš účet byl deaktivován, obraťte se prosím na administrátora.
                    <?php } ?>
                </p>

                <p>Nemáte účet?
                    <a href="register.php">Registrovat</a>
                </p>

                <button type="submit" class="btn btn-bd-primary btn-save btn-login">Přihlásit</button>
            </form>
        </article>
    </section>
</main>





<?php if (isset($_GET['registered'])){ ?>

    <!--Modal JS Script -->
    <script type="text/javascript">
        window.onload = () => {
            $('#onload').modal('show');
        }
    </script>

    <div class="modal fade" id="onload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrace byla úspěšná</h5>
                </div>
                <div class="modal-body">
                    Nyní se můžete přihlásit.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

</body>
</html>
