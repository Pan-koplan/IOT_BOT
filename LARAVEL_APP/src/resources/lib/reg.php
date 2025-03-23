<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
if (strlen($login) < 4) {
    echo "login too short, sorry)";
    exit;
}
if (strlen($password) < 4) {
    echo "password too short, sorry)";
    exit;
}
if (strlen($email) < 4 && !str_contains($email, "@")) {
    echo "email too short, sorry)";
    exit;
}
if (strlen($name) < 4) {
    echo "name too short, sorry)";
    exit;
}
echo $login;
// Password
$salt = 'fkdsfjjl@#!@#231441asFGDSJk';
$password = md5($salt . $password);

//db
require "db.php";
$sql = 'INSERT INTO users_db(login, name, email, password) VALUES(?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$login, $name, $email, $password]);
header('location: /index.php');
