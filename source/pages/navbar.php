<?php

/**
 * @var  CategoryRepository $categoryRepo
 * @var AuthorRepository $authorRepo
 * @var string $page
 */

$menuCategorySource = $categoryRepo->getLastFiveCategories();
$menuAuthorSource = $authorRepo->getLastFiveAuthors();

if (!isset($_SESSION)){
    session_start();
}

?>


<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php"><img src="../source/images/Logo-dark.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'home' ? 'active' : '' ?> "
                       aria-current="page" href="../articles">Zprávy</a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle <?= $page == 'category' ? 'active' : '' ?>"
                       href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Kategorie
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($menuCategorySource as $item) { ?>
                            <li>
                                <a class="dropdown-item"
                                   href="../category/articles.php?category_id=<?= $item['category_id'] ?>"><?= $item['category_name'] ?>
                                </a>
                            </li>
                        <?php } ?>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../category">Všechny kategorie</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= $page == 'author' ? 'active' : '' ?>"
                       href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Autoři
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($menuAuthorSource as $item) { ?>
                            <li>
                                <a class="dropdown-item"
                                   href="../author/articles.php?author_id=<?= $item['id'] ?>"><?= $item['name'] ?> <?= $item['surname'] ?>
                                </a>
                            </li>
                        <?php } ?>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../author">Všichni autoři</a></li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['user'])) { ?>
                    <?php if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'editor') { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= $page == 'admin' ? 'active' : '' ?>"
                               href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Administrace
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../admin">Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../admin/articles.php">Články</a></li>
                                <li><a class="dropdown-item" href="../admin/categories.php">Kategorie</a></li>

                                <?php if ($_SESSION['user']['role'] == 'admin') { ?>
                                    <li><a class="dropdown-item" href="../admin/authors.php">Autoři</a></li>
                                    <li><a class="dropdown-item" href="../admin/users.php">Uživatelé</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <div class="navbar-text">
                <?php if (isset($_SESSION['user'])) { ?>
                    <a class="nav-link " href="">
                        <?= $_SESSION['user']['name'] ?>
                        <?= $_SESSION['user']['surname'] ?>
                    </a> |
                    <a class="nav-link logout-link" href="../user/logout.php">
                        <!--                       <p>Odhlásit</p>-->
                        <img src="../source/icons/sign-out.svg" class="sign-in-icon">
                    </a>
                <?php } else { ?>
                    <a href="../user/login.php" class="nav-link login-link">
                        <p>Přihlásit se</p>
                        <img src="../source/icons/sign-in.svg" class="sign-in-icon">
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
