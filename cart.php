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



foreach ($sortedArray as $sAi){
    array_push($mainCloneArray, $sAi);
}
//print_r($mainCloneArray);
//print_r($quantityArray);

//print_r(count($mainCloneArray));
//print_r($mainCloneArray);
for ($i = 0; $i <= count($mainCloneArray)-1; $i++) {
//    print_r($mainCloneArray[$i]);
    $product = $helper->getProductById($mainCloneArray[$i]);
    echo '
    <div>
    <h2>'.$product[0]['name'].' x'.$quantityArray[$i].' | '.$product[0]['price'].' монет за 1 шт.</h2>
    
</div>
    ';
}
echo '<p>----------------------------------------------------------------------------------</p>';
echo '<h2>Всего: '.$total.' монет.</h2>';
//foreach ($sortedArray as $sAi){

//}

echo ' <h1>Корзинка</h1>';

