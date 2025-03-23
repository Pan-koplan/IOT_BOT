<?php
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

if (strlen($password) < 2) {
    echo "password too short, sorry)";
    exit;
}
echo $name;
if (strlen($name) < 2) {
    echo "name too short, sorry)";
    exit;
}
// Password
$salt = 'fkdsfjjl@#!@#231441asFGDSJk';
$password = md5($salt . $password);

//db
require "db.php";
$sql = 'SELECT id FROM users_db WHERE login = ? AND password = ?';
$query = $pdo->prepare($sql);
$query->execute([$name, $password]);
if ($query->rowCount() == 0)
    echo "Неправильный логин или пароль";
else {
    setcookie("name", $name, time() + 1 * 3600 * 24 * 30, "/");
    header('location: /user.php');
}
