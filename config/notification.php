<?php 


if(isset($_POST["btn"]))
{


    $txtDosyaYolu = 'C:\xampp\htdocs\shop\page\notification\duyuru.txt';


    $name =$_POST["name"];

    $text =$_POST["text"];

    $tarih  = date("Y-m-d");

    $dosya = fopen($txtDosyaYolu , "a+");

    $sonId = 1; 
    while ($satir = fgets($dosya)) {
        if (strpos($satir, 'Id:') === 0) {
            $sonId = (int)trim(substr($satir, strlen('Id:')));
        }
    }

    $yeniId = $sonId+1;
    
    $veri = "\n\nId:$yeniId\nName:$name\nText:$text\nDate:$tarih\n\n";

    $yaz = fwrite($dosya, $veri );

    if($yaz)
    {
        $msj = "Duyuru Eklendi";
        setcookie("msj", $msj,time()+5, "/");
    }
    else
    {
        $msj = "Duyuru eklenirken hata oluştu.";
        setcookie("msj", $msj,time()+5, "/");
    }

    fclose($dosya);

    header("Location:../page/newnotification.php");
}