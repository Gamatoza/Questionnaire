<?php
require_once('../module/config.php');
global $conn;
require_once('../module/config.php');

if(!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: login.php");