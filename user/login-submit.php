<?php

require_once '../App.php';
App::init();

$db = new Database();
$userRepo = new UserRepository($db);

if (empty($_POST)) {
//    echo "empty post";
    header('Location: login.php?error=empty-field');
    die();
}

$mail = $_POST['mail'];
$pass = $_POST['pass'];

if (empty($mail) || empty($pass)){
//    echo "empty mail or pass";
    header('Location: login.php?error=empty-field');
    die();
}

$user = $userRepo->GetUserLogin($mail);

if (!$user || !password_verify($pass, $user['password'])){
//    echo "invalid credentials";
    header('Location: login.php?error=invalid-credentials');
    die();
}

if ($user['active'] == 0){
//    echo "inactive account";
    header('Location: login.php?error=inactive-account');
    die();
}

session_start();
$_SESSION['user'] = $user;

header('Location: ../articles');