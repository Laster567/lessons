<?php
//die($_POST['test']);
include 'Header.html';
$Product_id = $_POST['pId'];
require_once "Dbhelper.php";
$helper = new DBhelper();
$helper ->connect();
$Product = $helper ->getProductById($Product_id);
$Product = $Product[0];
echo "
<div class='product_content'>
<h1>".$Product['name']."</h1>
<img  class='product_img' src='".$Product['image']."'>
<h2>".$Product['price']." руб.</h2>
<h2>".$Product['description']."</h2>
</div>
";

