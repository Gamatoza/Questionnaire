<?php

if(!isset($_SESSION))
{
    session_start();
}

if (isset($_SESSION["userid"]) && $_SESSION["userid"] === true) {
    header("location: index.php");
    exit;
}