<?php

require_once '../tools/access-editor.php';

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

$tableData = $categoryRepo->getCategoryTableData();