<?php
require_once '../../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

//if (isset($_SESSION['uid']))
//    header("location: index.php");


$users = $conn->query("SELECT * FROM questionnaire.users;");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link rel="stylesheet" href='../../node_modules/bootstrap/dist/css/bootstrap.min.css'
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/login-style.css">

</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
<main class="form-signin w-100 m-auto">
    <form id="form" method="post" action="../../includes/login_form_handler.php" name="test-form">
        <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>
        <div class="form-floating">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Login" autocomplete="off" required>
            <label for="floatingInput">Login</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"
                   required>
            <label for="floatingPassword">Password</label>
        </div>
        <div class="text-body">
            <pre><?= $_SESSION['message'] ?? '' ?></pre>
        </div>
        <button class="btn btn-primary w-100 py-2" id="login" type="submit" value="login">Sign in</button>
        <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2023 Company, Inc</p>
    </form>
</main>
</body>
</html>