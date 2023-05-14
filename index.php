<?php
include 'Header.html';
session_start();
require_once "Dbhelper.php";
$helper = new DBHelper();
$helper->connect();
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




