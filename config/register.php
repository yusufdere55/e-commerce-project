<?php 
session_start();

include_once "config.php";

$database = new Config("localhost", "root", "", "shop");

if (isset($_POST["btn"])) {
    $name = mysqli_real_escape_string($database->conn, $_POST["name"]);
    $surname = mysqli_real_escape_string($database->conn, $_POST["surname"]);
    $mail = mysqli_real_escape_string($database->conn, $_POST["mail"]);
    $phone = mysqli_real_escape_string($database->conn, $_POST["phone"]);
    $pwd = mysqli_real_escape_string($database->conn, $_POST["pwd"]);

    $login = mysqli_query($database->conn, "SELECT * FROM users WHERE usermail = '$mail'");


        if (mysqli_num_rows($login) > 0) {
            echo "Kullanıcı mevcut";
            $message = "Kullanıcı mevcut";
            setcookie("message", $message, time() + 5, "/");
            header("Location:http://localhost/shop/page/register.php");
            exit;
        } else {
            $sql = mysqli_query($database->conn, "INSERT INTO users (username, usersurname, usermail, userphone, userpwd) VALUES (
                 '".$name."', '".$surname."', '".$mail."', '".$phone."', '".$pwd."')");
            if ($sql) {
                $message = "Kullanıcı kaydı başarılı";
                setcookie("message", $message, time() + 5, "/");
                header("Location:http://localhost/shop/page/register.php");
                echo "kayıt başarılı";
            }
        }

}
?>
