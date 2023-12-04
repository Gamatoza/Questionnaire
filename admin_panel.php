<?php
require_once 'config.php';
global $conn;
require_once 'session.php';

if(!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: login.php");

