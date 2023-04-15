<?php
include 'Header.html';
require_once "Dbhelper.php";
$helper = new DBHelper();
$helper->connect();
session_start();
echo $_SESSION['user'];
echo $_POST['points'];
echo $_POST['multi'];
$helper->updateBalance($_SESSION['user'],$_POST['points'] * $_POST['multi']);
echo "
<h1 style='color: white'>".$_POST['points']."*".$_POST['multi']." = ".$_POST['points'] * $_POST['multi']."</h1>
";