<?php
require_once '..\config\constants.php';
$cfg = AppConfig::getInstance();
require_once $cfg->includesPath["scripts.php"];
$conn = $cfg->connection;

if(!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: login.php");