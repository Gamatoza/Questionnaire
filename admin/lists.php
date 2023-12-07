<?php
define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT'].'/Questionnaire');
require_once(ROOT_PATH.'/module/config.php');
global $conn;
require_once(ROOT_PATH.'/module/config.php');

if(!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: login.php");