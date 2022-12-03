<?php


require_once '../tools/access-editor.php';

require_once '../App.php';
App::init();

$db = new Database();
$categoryRepo = new CategoryRepository($db);
$authorRepo = new AuthorRepository($db);
$articleRepo = new ArticleRepository($db);
$userRepo = new UserRepository($db);

$from = $_GET['from'];
$id = $_GET['id'];

if ($from == 'categories' && $categoryRepo->checkDelete($id)) {
    $categoryRepo->delete($id);

} else if ($from == 'articles') {
    $articleRepo->delete($id);

} else if ($from == 'authors' && $authorRepo->checkDelete($id)) {

    if ($_SESSION['user']['role'] == 'admin'){
        $authorRepo->delete($id);
    }

} else if ($from == 'users') {
    if ($_SESSION['user']['role'] == 'admin'){
        $userRepo->delete($id);
    }
}

header('Location: ' . $from . '.php');
