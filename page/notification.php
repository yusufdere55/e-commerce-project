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
    <title>Duyurular</title>
    <?php include __DIR__."../../include/link.php"; ?>
</head>

<body>
    <?php include "../include/header.php";?>
    <div class="container">
        <div class="row text-center pt-3 border-size-1 border-bottom border-dark">
            <div class="title d-flex flex-rows justify-content-center gap-5">
                <h2 style="font-weight: 600;">Duyurular</h2>
                <a href="newnotification.php" style="height:40px; width:40px;display:flex;justify-content:center;align-items:center;border:1px solid black; border-radius:5px; background-color:black;"><i class="fa-solid fa-plus text-white"></i></a>
            </div>
        </div>
        <div class="row" style="min-height:500px;">
            <div class="d-flex flex-column p-5">

        <?php
            // Txt dosyasının yolunu belirtin
            $txtDosyaYolu = 'notification/duyuru.txt';
            
            // Dosyayı okuma modunda aç
            $dosya = fopen($txtDosyaYolu, 'r');
            
            // Dosyadan okunan içeriği depolamak için bir dizi oluştur
            $duyuruBilgileri = array();
            
            // Dosyadan sıradaki satırı oku
            while (($satir = fgets($dosya)) !== false) {
            
                // "Id:" ile başlayan satırları kontrol et
                if (strpos($satir, 'Id:') === 0) {
                
                    // Mevcut duyuru bilgilerini ekrana yazdır
                    if (!empty($duyuruBilgileri)) {
                        echo "<div>"; ?>
                            <h5>-<font style="font-style:italic; font-weight:500;"> <?php echo $duyuruBilgileri['Name']; ?> </font>
                            </h5>
                            <p style="padding: 0 50px;"><?php echo $duyuruBilgileri['Text']; ?></p>
                            <?php echo "</div>";
                    }
                
                        // Yeni bir duyuru başladığında, duyuru bilgilerini sıfırla
                        $duyuruBilgileri = array();
                    
                        // Mevcut Id'yi çek
                        $duyuruBilgileri['Id'] = (int)trim(substr($satir, strlen('Id:')));
                    }
                    // "Name:" ile başlayan satırları kontrol et
                    elseif (strpos($satir, 'Name:') === 0) {
                        $duyuruBilgileri['Name'] = trim(substr($satir, strlen('Name:')));
                    }
                    // "Text:" ile başlayan satırları kontrol et
                    elseif (strpos($satir, 'Text:') === 0) {
                        $duyuruBilgileri['Text'] = trim(substr($satir, strlen('Text:')));
                    }
                }
            
            // Dosyayı kapat
            fclose($dosya);
            
            // Son duyuru bilgilerini ekrana yazdır
            if (!empty($duyuruBilgileri)) {
                echo "<div>"; ?>
                            <h5>- <font style="font-style:italic; font-weight:500;"> <?php echo $duyuruBilgileri['Name']; ?> </font>
                            </h5>
                            <p style="padding: 0 50px;"><?php echo $duyuruBilgileri['Text']; ?></p>
                            <?php echo "</div>";
            } else {
                echo 'Hiç duyuru bulunamadı.';
            }
            ?>

            </div>


        </div>

    </div>

    <?php include __DIR__."/../include/footer.php";?>
</body>

</html>