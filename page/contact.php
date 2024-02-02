<?php
session_start();
@$usrid = $_SESSION["userid"];
include_once "".__DIR__ ."/../config/config.php";
$database = new Config("localhost", "root", "", "shop");
include_once('../shopping/php/component.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__."../../include/link.php"; ?>
    <title>Contact Page</title>
</head>

<body>
    <?php include "../include/header.php";?>
    <div class="container-fluid p-5">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card-title">İletişim Bilgileri
                    <hr>
                </div>
                <div class="card-text" style="font-size:14px;">
                    <ul class="d-flex flex-column gap-3 aling-item-center">
                        <li><b>Adress :</b> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius praesentium
                            voluptatibus beatae adipisci.</li>
                        <li><b>Mail Adress1 :</b> admin@shop.com</li>
                        <li><b>Mail Adress2 :</b> admin1@shop.com</li>
                        <li><b>Phone : </b>+90(151) 456 45 65</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <form action="http://localhost/shop/config/contact.php" method="post">
            <div class="row d-flex justify-content-center">
                <div class="card text-center p-4" style="width: 24em;">
                    <div class="card-title">
                        <h2>
                            <b>./</b> <small>Bize Ulaşın</small>
                        </h2>
                    </div>
                    <div class="card-body d-flex gap-3 flex-column">
                        <input class="form-control" name="ad" type="text" placeholder="Ad Soyad"
                            aria-label="default input example" required>
                        <input class="form-control" name="mail" type="email" placeholder="E-Posta"
                            aria-label="default input example" required>
                        <input class="form-control" name="konu" type="text" placeholder="Konu" aria-label="default input example" required>
                        <textarea class="form-control" name="mesaj" placeholder="Mesajınız" id="floatingTextarea" required   ></textarea>
                        <button type="submit" name="mail-btn" class="btn btn-success">Gönder</button>
                        <?php

                            if(isset($_COOKIE["mailerror"]))
                            {
                                echo $_COOKIE["mailerror"];
                            }
                        
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include __DIR__."/../include/footer.php";?>
</body>

</html>