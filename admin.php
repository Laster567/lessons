<?php

require_once "Dbhelper.php";
$helper = new DBhelper();
$helper ->connect();
//print_r($helper ->getProductById(1)) ;

$isAut = false;
if ($_POST['pass'] != "password"){
    if ($_POST != null){
        echo "Неверный пароль";
    }
}
else{
    $isAut = true;
}


if ($isAut == false){
    echo '<form action="/lessons/admin.php" method="POST" >
    <input type="text" name="pass" />
    <input type="submit" value="Ввести"/>
</form>';
}

if ($isAut == true){
    echo '<form action="admin.php" method="POST" ">
    <input type="text" name="name" placeholder="Имя" />
    <input type="text" name="price" placeholder="Цена" />
    <input type="text" name="desc"  placeholder="Описание"/>
    <input type="text" name="img" placeholder="Картинка"/>
    <input type="hidden" name="pass" value="password"/>
    <input type="submit" value="Создать" />
    </form>';

    if ($_POST['name']!="" && $_POST['price']!="" && $_POST['desc']!="" && $_POST['img']!=""){
        $helper->createUser($_POST['name'],$_POST['price'],$_POST['desc'], $_POST['img']);
    }
}












//<script type="text/javascript">
//    function Func(){
//        alert("Форма отправлена!");
//    }
//</script>
//<form action="/t1.php" method="POST" onSubmit="Func();">
//    <input type="hidden" name="name" value="value" />
//    <input type="submit" value="Отправить" />
//</form>