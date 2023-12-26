<?php
session_start();

include_once "config.php";

$database = new Config("localhost", "root", "", "shop");


if(isset($_POST["btn"])){

    $mail = $_POST["mail"];
    $pwd = $_POST["pwd"];
    $login = "SELECT * FROM users WHERE usermail = '$mail' && userpwd = '$pwd'  ";
    $result = mysqli_query($database->conn,$login);
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
        $_SESSION["id_array"] = $_SESSION["id_array"] ?? array();
        if(in_array($row["user_id"],$_SESSION["id_array"]))
        {
            echo "Zaten bu hesaba giriş yapmışsınız";
            header('Refresh:3 ; URL=../page/login.php');
        }
        else
        {
            
             $veriler = array(
            "id" => $row["id"],
            "adi" => $row["username"],
            "soyad" => $row["usersurname"],
            "mail" => $row["usermail"],
            "tel" => $row["userphone"],
            "sifre" => $row["userpwd"],
            "profile_photo" => $row["userphoto"],
        );
        // tüm session bilgilerinin tutulacağı session dizisi
        $_SESSION["array"][$row["id"]] = $veriler;

        // tüm üye idlerinin tutulacağı session dizisi
        $_SESSION["id_array"][] = $row["id"];

        // o anki açık oturumun üye id'si 
        $_SESSION["userid"] = $row["id"];
        header("Location:../index.php");

        }
    }
    else{
        echo "Kullanıcı bulunamadı:" . "<a href='../page/login.php'>Yeniden Dene</a>";
    }
}