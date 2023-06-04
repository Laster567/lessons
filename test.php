<?php
require_once "Dbhelper.php";
session_start();
$uid = $_SESSION['user'];
$cart = $_SESSION['cart'];
echo print_r($_GET);

$helper = new DBhelper();
$helper->connect();
if ($_GET['param'] == "all"){
    $helper->deleteFromCart($_GET['cart_id'], $_GET['product_id']);
}
if ($_GET['param'] == 'dec'){
    $helper->productDecreasse($_GET['cart_id'], $_GET['product_id']);
}

if ($_GET['param'] == 'inc'){
    $helper->addToCart($_GET['product_id'],$_GET['cart_id']);
}

if ($_GET['param'] == 'buy'){
    foreach ($helper->getCartById($cart) as $item){
        $helper->createOrder($uid, $item['Product_id']);
//        $helper->productDecreasse($cart, $item['product_id']);
    }


    $itemsArray = array();
    foreach ($helper->getCartById($cart) as $item){
        array_push($itemsArray, $item['Product_id']);
    }
    $total=0;

    foreach ($itemsArray as $item2){
        $product = $helper->getProductById($item2);
        $total = $total+ $product[0]['price'];
    }
    $user = $helper->getUser($uid);
    $itog = (intval($user['balance']) - intval($total));
    $helper->changeBalance($uid, $itog);


    foreach ($helper->getCartById($cart) as $item){
        $helper->deleteFromCart($_GET['cart_id'], $item['Product_id']);
    }



}