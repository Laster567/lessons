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

$data = array(

);
$orders = $helper -> getAll('orders');
$used = array(
);
foreach ($orders as $order){
    if ($order['user_id'] == $_SESSION['user']){
        $product = $helper->getProductById($order['product_id'])[0];


            if (!in_array($product['name'],$used)){
                $object = array(
                    "name" => $product['name'],
                    "quantity" => $helper->getQuantity($_SESSION['user'],$product['id']),
                    "image" => $product['image'],
                    "sellprice" => 10
                );
                $used[] = $product['name'];
                $data[] = $object;
            }

//        $used[] = $product['name'];
    }
}
echo ' <h1>Личный Кабинет</h1>';
//var_dump($used);
echo ' <h2>Ваши покупки</h2>
 <div class="grid">';

foreach ($data as $o){
    echo '
        <div class="card" >
                <div class="card-content">
                <img class="card-img" src="'.$o["image"].'">
                <h1 style="
                    margin-top: 0px;
                    margin-bottom: 0px;
                    text-align: center;">
                    '.$o['name'].'
                </h1>
                <div class="card-text">
                    <b>'.$o["quantity"].' шт.</b>
                </div>
               
            </div>
            </form>
            <a href="'.$o["image"].'" class="btnn">Открыть</a>
            
        </div>
';
}

echo '
</div>
 ';

