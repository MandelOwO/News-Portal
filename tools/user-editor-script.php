<?php

require_once '../tools/access-admin-only.php';

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$userRepo = new UserRepository($db);
$tool = new Tools();

$error = 0;

/* LOAD */
$user = false;
if (!empty($_GET['id'])) {
    $user = $userRepo->getById($_GET['id']);
}

$authors = $authorRepo->getAuthorTableData();

/* SAVE */

if (isset($_POST) && !empty($_POST)) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $mail = trim($_POST['mail']);
    $role = $_POST['role'];
    $active = $_POST['active'];

    $authorId = null;


    if ($role == 'editor' && !empty($_POST['author']))
    {
        $authorId = $_POST['author'];
    } else if ($role == 'editor' && empty($_POST['author'])){
        $error = 1;
    } else if ($role != 'editor' && !empty($_POST['author'])) {
        $error = 2;
    }


    if (!empty($name) && !empty($surname) && !empty($mail) && $error == 0) {

        try {
            $userRepo->update($user['id'], $mail, $name, $surname, $role, $active, $authorId);
            header('Location: users.php');
        } catch (Exception $ex){
            $error = 3;
        }


    }
}
