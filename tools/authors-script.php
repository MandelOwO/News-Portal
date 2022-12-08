<?php

require_once '../tools/access-admin-only.php';

require_once '../App.php';
require_once '../tools/Tools.php';
App::init();

$db = new Database();
$authorRepo = new AuthorRepository($db);
$categoryRepo = new CategoryRepository($db);
$tool = new Tools();

$tableData = $authorRepo->getAuthorTableData();