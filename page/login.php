<?php
session_start();
@$id = $_SESSION["userid"];
include_once "".__DIR__ ."/../config/config.php";
$database = new Config("localhost", "root", "", "shop");
include_once('../shopping/php/component.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <?php include __DIR__."../../include/link.php"; ?>
</head>

<body>
    <?php include "../include/header.php";?>
    <div class="container">
        <form action="http://localhost/shop/config/login.php" method="post">
            <div class="row text-center py-5 px-2 justify-content-center">
                <div class="card col-md-4 py-5 gap-5 px-5">
                    <h3 class="card-title">
                        <b>./</b> <small>Login Page</small>
                    </h3>
                    <input type="email" name="mail" class="form-control" placeholder="E-Mail" required id="">
                    <input type="password" name="pwd" class="form-control" placeholder="Password" required id="">
                    <button type="submit" name="btn" class="btn btn-success">Giriş Yap</button>
                    <div class="register gap-2 d-flex justify-content-center">
                        <span>Henüz hesabınız yok mu?</span><a href="http://localhost/shop/page/register.php" class="text-primary">Kayıt Ol</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>