<?php
require_once('module/config.php');
global $conn;
require_once('module/config.php');


if ($_POST['username'] or $_POST['password']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $conn->prepare("SELECT * FROM users WHERE name=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        $_SESSION['message'] = "Логин или пароль неправильно.";
        $_SESSION['username'] = FALSE;
        header("location: login.php");
        echo "Такого пользователя не существует!";
    } else {
        if ($result['password'] == $password) { //password_verify($password, $result['password']) password_hash("admin",PASSWORD_DEFAULT); TODO: хешировать пароли
            $_SESSION['uid'] = $result['id'];
            header("location: admin\index.php");
        } else {
            $_SESSION['message'] = "Неправильный логин или пароль";
            $_SESSION['username'] = FALSE;
            header("location: login.php");
        }
    }
}

