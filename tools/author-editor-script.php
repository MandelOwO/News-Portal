<?php
require_once '../tools/access-admin-only.php';

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

/* LOAD */
$author = false;
if (!empty($_GET['id'])) {
    $author = $authorRepo->getById($_GET['id']);
}

/* SAVE */

if (isset($_POST) && !empty($_POST)) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $profile_photo = trim($_POST['photo']);

    if (!empty($name) && !empty($surname)) {
        if (!$author) {
            $authorRepo->insert($name, $surname, $profile_photo);
            header('Location: authors.php');
        } else {
            $authorRepo->update($author['id'], $name, $surname, $profile_photo);
            header('Location: authors.php');
        }
    }
}