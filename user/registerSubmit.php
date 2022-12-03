<?php

require_once '../App.php';
App::init();

$db = new Database();
$userRepo = new UserRepository($db);

var_dump($_POST);

if (empty($_POST)) {
    echo "empty post";
    header('Location: register.php?error=empty-field');
    die();
}

$mail = trim($_POST['mail']);
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

// Check values
if (empty($mail) || empty($name) || empty($surname) || empty($_POST['pass'])) {
    var_dump($mail);
    var_dump($name);
    var_dump($surname);
    var_dump($pass);

    echo "empty value";
    header('Location: register.php?error=empty-field');
    die();
}

// Check email availiblity
if (!$userRepo->CheckEmail($mail)) {
    echo "bad mail";
    header('Location: register.php?error=email-taken');
    die();
}

$userRepo->RegisterUser($mail, $pass, $name, $surname);

echo "Registration succesfull";