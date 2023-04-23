<?php
require_once "Dbhelper.php";
$helper = new DBHelper();
$helper->connect();

$helper->addToCart($_GET['id'],$_GET['cart_id']);
