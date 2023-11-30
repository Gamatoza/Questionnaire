<?php
require_once 'session.php';
global $conn;
require_once 'config.php';


$users = $conn->query("SELECT * FROM questionnaire.users;");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form | CodingLab</title>
    <link rel="stylesheet" href="source/css/loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>

<body>
<div class="container">
    <div class="wrapper">
        <div class="title"><span>Login Form</span></div>
        <form id="form" method="post" action="loginproceed.php" name="sign-form">
            <div class="row">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Email or Phone" required>
            </div>
            <div class="row">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="row button">
                <input id="login" type="submit" value="Login">
            </div>
            <div class="text-body">
                <pre><?=isset($_SESSION['message'])?$_SESSION['message']:''?></pre>
            </div>
        </form>
    </div>
</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
</html>