<?php

session_start();

$siteAcess = false;

if ($_SESSION['user']['role']=='editor'){
    $siteAcess = true;
} elseif ($_SESSION['user']['role']=='admin'){
    $siteAcess = true;
}

if (!$siteAcess){
    header('Location: ../articles');
    die();
}