<?php
include 'Header.html';
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

if (isset($_POST['login']) && isset($_POST['password'])){
    if ($_POST['submit'] == "Войти"){
        if ($helper->checkAuth($_POST['login'],$_POST['password'])){
            $_SESSION['user'] = $helper->checkAuth($_POST['login'],$_POST['password']);
            $_SESSION['cart'] = $helper->createCart($_SESSION['user']);
            print_r($_SESSION['user']);
            if ($_POST['remember']){
                $_SESSION['isAuth'] = true;
            }
            include './card.php';
        }else{
            include "loginForm.html";
        }
    }else{
        $helper->registrateUser($_POST['login'],$_POST['password']);
        $_SESSION['user'] = $helper->checkAuth($_POST['login'],$_POST['password']);
        $_SESSION['cart'] = $helper->createCart($_SESSION['user']);
        if ($_POST['remember']){
            $_SESSION['isAuth'] = true;
        }
        include './card.php';
    }

}else{
    if ($_SESSION['isAuth']){
        $_SESSION['cart'] = $helper->createCart($_SESSION['user']);
        include './card.php';
    }else{
        include "loginForm.html";
    }
}


