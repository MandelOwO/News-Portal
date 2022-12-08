<?php

require_once '../tools/access-editor.php';

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();



$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

/* LOAD */
$category = false;
if (!empty($_GET['id'])) {
    $category = $categoryRepo->getById($_GET['id']);
}

/* SAVE */

if (isset($_POST) && !empty($_POST)){

    $name = trim($_POST['name']);

    if (!empty($name) && !$category)
    {
        $categoryRepo->insert($name);
        header('Location: categories.php');
    } else if(!empty($name) && $category){
        $categoryRepo->update($category['id'], $name);
        header('Location: categories.php');
    }
}