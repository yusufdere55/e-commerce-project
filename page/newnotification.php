<?php 
session_start();
@$usrid = $_SESSION["userid"];
include_once __DIR__ ."/../config/config.php";
$database = new Config("localhost", "root", "", "shop");
include_once('../shopping/php/component.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyuru Ekle</title>
    <?php include __DIR__."../../include/link.php"; ?>
</head>

<body>
    <?php include "../include/header.php";?>
    <div class="container">

        <form action="http://localhost/shop/config/notification.php" method="post">
            <div class="row d-flex justify-content-center w-100 pt-3 ">
                <div class="card text-center p-4" style="width: 24em;">
                    <div class="card-title">
                        <h2>
                             <small>Duyuru Ekle</small>
                        </h2>
                    </div>
                    <div class="card-body d-flex gap-3 flex-column">
                        <input class="form-control" name="name" type="text" placeholder="Başlık"
                            aria-label="default input example" required>
                        
                        <textarea class="form-control" name="text" placeholder="İçerik" id="floatingTextarea"
                            required></textarea>
                        <button type="submit" name="btn" class="btn btn-success">Ekle</button>
                        <?php

                            if(isset($_COOKIE["msj"]))
                            {
                                echo $_COOKIE["msj"];
                            }
                        
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>