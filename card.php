<?php
require_once "Dbhelper.php";
$helper = new DBhelper();
$helper-> connect();
$data = $helper ->getAll("products");





echo '<div class="content"><div class="grid">';
foreach ($data as $d){
    echo '
        <div class="card" >
            <form id="card' .$d['id'].'" onclick="openOrder(openOrder(\'card' .$d['id']. ' .$d['id'].'">
                <div class="card-content">
                <img class="card-img" src="'.$d["image"].'">
                <h1 style="
                    margin-top: 0px;
                    margin-bottom: 0px;
                    text-align: center;">
                    '.$d['name'].'
                </h1>
                <div class="card-text">
                    <b>'.$d["price"].' руб.</b>
                </div>
               
            </div>
            </form>
            <form id="card' .$d['id'].'" action="buy.php" method="post">
                <button cartId = "'.$_SESSION['cart'].'" id="' .$d['id'].'">Добавить в корзину</button>
            </form>
            
        </div>
';
}
echo'</div></div>';