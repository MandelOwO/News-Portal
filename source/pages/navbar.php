<?php

require_once '../../App.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);

$menuCategorySource = $categoryRepo->getLastFiveCategories();
$menuAuthorSource = $authorRepo->getLastFiveAuthors();


?>


<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="../source/images/Logo-dark.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $_GET['page'] == 'home' ? 'active' : '' ?> "
                       aria-current="page" href="../articles">Zprávy</a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle <?= $_GET['page'] == 'category' ? 'active' : '' ?>"
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
                    <a class="nav-link dropdown-toggle <?= $_GET['page'] == 'author' ? 'active' : '' ?>"
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

            </ul>
            <form class="d-flex search" role="search">
                <input class="form-control me-2" type="search" placeholder="Vyhledat na webu" aria-label="Search"
                       name="search">
                <button class="btn btn-primary" type="submit">Vyhledat</button>  <!-- TODO search -->
            </form>
        </div>
    </div>
</nav>