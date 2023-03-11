<?php
require_once "Dbhelper.php";
$helper = new DBhelper();
$helper-> connect();
$data = $helper ->getAll("products");





echo '<div class="content"><div class="grid">';
foreach ($data as $d){
    echo '
        <div class="card">
            <form action="product.php" method="post">
                <input type="hidden" name="pId" value="'.$d['id'].'">

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
                <input type="submit" class="card-button" value="Подробнее...">
            </div>
            </form>
        </div>
';
}
echo'</div></div>';