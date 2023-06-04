<?php
include 'Header.html';
$uid = 1;
session_start();
require_once "Dbhelper.php";
$helper = new DBHelper();
$helper->connect();
$user = $helper->getUser($_SESSION['user']);
echo '
<a class="btn-modal" href="#modal-block">Баланс</a>
<!-- Содержимое модального окна -->
<div id="modal-block">
  <a class="close-block" href="#close-block">X</a>
  <h3>'.$user['login'].'</h3>
  <p><b>Ваш баланс: </b>'.$user['balance'].'</p>
</div>
';

echo ' <h1>Личный Кабинет</h1>';