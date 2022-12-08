<?php

require_once '../tools/access-editor.php';

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$articleRepo = new ArticleRepository($db);
$tool = new Tools();

/* LOAD */
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

/* SAVE */
if (isset($_POST) && !empty($_POST)) {
    $title = trim($_POST['title']);
    $perex = trim($_POST['perex']);
    $text = $_POST['article-text'];
    $author_id = $_POST['author'];

    $published = 0;
    if (isset($_POST['published']) && $_POST['published'] == 1) {
        $published = 1;
    }

    $categories = [];
    if (isset($_POST['category'])) {
        $categories = $_POST['category'];
    }

    require_once '../tools/uploader.php';
    /** @var string $file_name_new */

    if (!$article) {

        $lastId = $articleRepo->insert($title, $perex, $text, $file_name_new, $author_id, $published);
        $categoryRepo->updateCategoriesForArticle($lastId, $categories);
    } else {
        $articleRepo->update($_GET['id'], $title, $perex, $text, $file_name_new, $author_id, $published);
        $categoryRepo->updateCategoriesForArticle($_GET['id'], $categories);
    }

    header('Location: articles.php');
}
