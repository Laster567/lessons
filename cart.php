<?php
include 'Header.html';
require_once "Dbhelper.php";
$helper = new DBhelper();
$helper ->connect();
session_start();
$uid = $_SESSION['user'];
$cart = $_SESSION['cart'];
$itemsArray = array();
$sortedArray = array();
$quantityArray = array();
$mainCloneArray = array();
$total = 0;
$user = $helper->getUser($uid);


echo '
<a class="btn-modal" href="#modal-block">Баланс</a>
<!-- Содержимое модального окна -->
<div id="modal-block">
  <a class="close-block" href="#close-block">X</a>
  <h3>'.$user['login'].'</h3>
  <p><b>Ваш баланс: </b>'.$user['balance'].'</p>
</div>
';

echo '<div style="display:none" id="data_cart" cartid="'.$cart.'"></div>';
foreach ($helper->getCartById($cart) as $item){
    array_push($itemsArray, $item['Product_id']);
}
$sortedArray = array_unique($itemsArray);


foreach ($itemsArray as $item){
    $product = $helper->getProductById($item);
    $total = $total+ $product[0]['price'];
}

foreach ($sortedArray as $el){
    $counter = 0;
    foreach ($itemsArray as $iAi){
        if ($iAi == $el){
            $counter = $counter+1;
        }
    }
    array_push($quantityArray, $counter);
}


echo '<div class = "cart_main" style="display: grid; width: fit-content">';
foreach ($sortedArray as $sAi){
    array_push($mainCloneArray, $sAi);
}
//print_r($mainCloneArray);
//print_r($quantityArray);

//print_r(count($mainCloneArray));
//print_r($mainCloneArray);

for ($i = 0; $i <= count($mainCloneArray)-1; $i++) {
//    print_r($product);
    $product = $helper->getProductById($mainCloneArray[$i]);
    echo '
    <span style="display: inline-flex">
    <button class="cart_main_button dec" productId = "'.$product[0]['id'].'">-</button>
    <h2 style="width: 100%; padding: 7px">'.$product[0]['name'].' x'.$quantityArray[$i].' | '.$product[0]['price'].' монет за 1 шт.</h2>
    <button class="cart_main_button inc" productId = "'.$product[0]['id'].'">+</button>
    <button productId = "'.$product[0]['id'].'" class="cart_main_button_all">Удалить всё</button>
    </span>

    ';

}
echo '</div>';
echo '<p>----------------------------------------------------------------------------------</p>';
//echo '<h2>У вас: '.$user['balance'].' монет.</h2>';
//echo '<h2>Всего: '.$total.' монет.</h2>';
//echo '<h2>Останется: ' . (intval($user['balance']) - intval($total)) .' монет.</h2>';
//foreach ($sortedArray as $sAi){
if (intval($user['balance'])<intval($total)){
    echo '
    <a href="game.php" class="fciA navItem"><span class="fciSpan">У вас недостаточно монет!</span></a>
    ';
}else{
    echo '
<a class="button11">'.$total.' монет.</a>
';
}

//}

echo ' <h1>Корзинка</h1>';
//$helper->changeBalance($uid, 1000000);


