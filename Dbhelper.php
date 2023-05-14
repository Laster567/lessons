<?php

class DBhelper {

    public $driver = 'mysql';
    public $host = 'localhost';
    public $db_name = 'shop';
    public $db_user = 'root';
    public $db_pass = 'root';
    public $charset = 'utf8';
    public $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    public $pdo;

    public function connect(){
        try{
            $this->pdo = new PDO (
                $dsn = "$this->driver: host=$this->host;dbname=$this->db_name;charset=$this->charset", $this->db_user, $this->db_pass, $this->options
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $i) {
            die("Ошибка подключения к базе данных");
        }
    }

    public function getAll($tableName){
        $statement = $this->pdo->query("SELECT * FROM $tableName");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;


    }

    public function createUser($name, $price, $desc, $img) {
        $this->pdo->query("INSERT INTO products (name, price, description, image) VALUES ('".$name."','".$price."', '".$desc."', '".$img."');");

    }
    public function  getProductById($id){
        $statement = $this ->pdo -> query("SELECT * FROM products WHERE id = $id");
        $result = $statement ->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function checkAuth($login, $password){
        $users = $this->getAll('users');
        foreach ($users as $user){
            if ($login == $user['login'] && $password == $user['password']){
                return $user{"id"};
            }
        }
        return false;
    }

    public function registrateUser($login, $password){
        $this->pdo->query("INSERT INTO users (name, login, password) VALUES ('user','".$login."', '".$password."');");
    }


    public function updateBalance($id,$value){
        $user = $this->getUser($id);
        $final_balance = $user['balance'] + $value;
        $this->pdo->query("UPDATE users SET balance = '".$final_balance."' WHERE (`id` = '".$id."');");
    }

    public function getUser($id){
        $user = $this->pdo->query("SELECT * FROM users WHERE id = '".$id."';");
        $result = $user ->fetchAll(PDO::FETCH_ASSOC);
        return $result[0];
    }

    public function createCart($id){
        $beginCartID = $this->pdo->query("SELECT * FROM carts WHERE users_id = '".$id."';");
        $beginResult = $beginCartID ->fetchAll(PDO::FETCH_ASSOC);
        if (!$beginResult[0]['id']){
            $this->pdo->query("INSERT INTO carts (users_id) VALUES ('$id');");
            $cartID = $this->pdo->query("SELECT * FROM carts WHERE users_id = '".$id."';");
            $result = $cartID ->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['id'];
        }else{
            return $beginResult[0]['id'];
        }
    }

    public function addToCart($productId,$cartId){
        $this->pdo->query("INSERT INTO cart_has_product (cart_id, Product_id) VALUES ('".$cartId."','".$productId."');");

    }

    public function  getCartById($id){
        $statement = $this ->pdo -> query("SELECT * FROM cart_has_product WHERE cart_id = $id");
        $result = $statement ->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
