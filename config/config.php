<?php

class Config
{
    public $servername;
    public $username;
    public $password;
    public $database;
    public $table;
    public $conn;

    public function __construct(
        $servername = "localhost",
        $username = "root",
        $password ="",
        $database = "shop",
        $table = "products"
    ){
        $this->table = $table;
        $this->database=$database;
        $this->password=$password;
        $this->username=$username;
        $this->servername=$servername;


        $this->conn = mysqli_connect($servername,$username,$password,$database);

        if(!$this->conn)
        {
            die("Connection Failed: ".mysqli_connect_error());
        }

    }

    public function getData(){
        $sql = "SELECT * FROM $this->table";
        $result = mysqli_query($this->conn,$sql);

        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }
    }

    public function getDataDesc(){
        $sql = "SELECT * FROM $this->table ORDER BY producttime DESC LIMIT  30";
        $result = mysqli_query($this->conn,$sql);

        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }
    }

    public function getDataRand(){
        $sql = "SELECT * FROM $this->table ORDER BY  RAND() LIMIT  30";
        $result = mysqli_query($this->conn,$sql);

        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }
    }

    public function getCategory(){
        $sql = "SELECT * FROM category ORDER BY id";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }

    }
    
    public function getCostumDataAsc($table,$tablesql){
        $sql = "SELECT * FROM $table ORDER BY $tablesql LIMIT 12";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }
    }

    public function getSearch($table,$data, $search)
    {
        $sql = "SELECT * FROM $table WHERE $data = $search ";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }
    }

    public function getAdress($table,$userId)
    {
        $sql = "SELECT * FROM $table WHERE userID = $userId";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
}