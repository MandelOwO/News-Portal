<?php

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$articleRepo = new ArticleRepository($db);
$tool = new Tools();

$article = false;
if (!empty($_GET['id'])) {
    $article = $articleRepo->getArticleById($_GET['id']);
    $articleCategories = $categoryRepo->getCategoriesForArticle($_GET['id']);

    $articleCategoriesIds = array_map(function ($cat) {
        return $cat['category_id'];
    }, $articleCategories);
}

$allAuthors = $authorRepo->getAll();
$allCategories = $categoryRepo->getAll();



?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLE LINKS -->
    <?php $tool->importBootstrap(); ?>
    <link rel="stylesheet" href="../source/styles/style.css">
    <script src="https://cdn.tiny.cloud/1/j9xmhw8bx062069njjeewsmov289hxxtzlcg26mdvr10jkdi/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="../source/scripts/tinymce.js"></script>

    <title>Neko admin | article editor</title>
</head>
<body>


<?php
$page = 'admin';
require_once '../source/pages/navbar.php';
?>

<main class="editor-page">

    <section class="page-header white-font author-editor-header">
        <h1>
            <?php if ($article) { ?>
                Upravit článek
            <?php } else { ?>
                Přidat článek
            <?php } ?>
        </h1>
        <a href="articles.php">
            <button type="button" class="btn btn-bd-primary">Zpět na výpis</button>
        </a>
    </section>

    <section class="editor">
        <form action="" method="post" id="article-form">

            <label for="author" class="label-header">Autor: </label>
            <select name="author" id="author" class="text-input select-box" required>
                <option value="" hidden>-- Vyberte autora --</option>
                <?php foreach ($allAuthors as $author) { ?>
                    <option value="<?= $author['id'] ?>" <?= $article && $article['author_id'] == $author['id'] ? 'selected' : '' ?>><?= $author['name'] ?> <?= $author['surname'] ?></option>
                <?php } ?>
            </select>

            <label for="title" class="label-header">Titulek: </label>
            <textarea name="title" id="title" class="text-input" required
            ><?= $article ? $article['title'] : '' ?></textarea>


            <label for="perex" class="label-header">Perex: </label>
            <textarea name="perex" id="perex" class="text-input" required
            ><?= $article ? $article['perex'] : '' ?></textarea>

            <label for="article-text" class="label-header">Text článku:</label>
            <textarea name="article-text" id="article-text" required
                      placeholder="Jste svědky zrození úžasného článku!"
            ><?= $article ? $article['text'] : '' ?></textarea>

            <label for="photo" class="label-header">Fotka: </label>
            <input type="url" name="photo" id="photo" class="text-input"
                   value="<?= $article ? $article['image'] : '' ?>">

            <label class="label-header">Kategorie: </label>
            <div class="categories-selection">
                <?php foreach ($allCategories as $category) { ?>
                    <div>

                        <label for="<?= $category['id'] ?>" class="category-label container"><?= $category['name'] ?>
                        <input type="checkbox" name="category[]" id="<?= $category['id'] ?>"
                               value="<?= $category['id'] ?>" class="checkbox"
                            <?= $article && in_array($category['id'], $articleCategoriesIds) ? 'checked' : '' ?>>
                        <span class="checkmark"></span>
                        </label>
                    </div>
                <?php } ?>
            </div>

            <button type="submit" class="btn btn-bd-primary btn-save">Uložit</button>
        </form>
    </section>
</main>

</body>
</html>
