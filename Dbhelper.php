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
        $this->pdo->query("INSERT INTO shop.products (name, price, description, image) VALUES ('".$name."','".$price."', '".$desc."', '".$img."');");

    }
    public function  getProductById($id){
        $statement = $this ->pdo -> query("SELECT * FROM shop.products WHERE id = $id");
        $result = $statement ->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
