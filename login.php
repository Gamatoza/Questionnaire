<?php
global $conn;
include_once 'connection.php';

$users = $conn->query("SELECT * FROM questionnaire.users;");
?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form | CodingLab</title>
    <link rel="stylesheet" href="source/css/loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<script>
    $(document).ready(function ()
    {
        $.ajax({
            type: "POST",
            url: 'logtime.php',
            data: "userID=" + userID,
            success: function(data)
            {
                alert("success!");
            }
        });
    });
</script>


<body>
<div class="container">
    <div class="wrapper">
        <div class="title"><span>Login Form</span></div>
        <form action="#">
            <div class="row">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Email or Phone" required>
            </div>
            <div class="row">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" required>
            </div>
            <div class="pass"><a href="#">Forgot password?</a></div>
            <div class="row button">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</div>

</body>
</html>