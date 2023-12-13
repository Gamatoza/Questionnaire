<?php
require_once '../../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

if(!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: login.php");