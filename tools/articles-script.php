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

if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){
    $tableData = $articleRepo->getAllArticles();
} else if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'editor'){
    $tableData = $articleRepo->getAllArticlesForAuthor($_SESSION['user']['author_id']);
}