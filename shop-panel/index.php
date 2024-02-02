<?php

session_start();
@$id = $_SESSION["userid"];

include "helper.php"; site_url();

define("SAYFA","page/");
define("SITE",$siteurl);

$activePage = isset($_GET["sayfa"]) ? $_GET["sayfa"] : "dashboard";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP PANEL</title>
    <?php include "include/link.php" ?>
</head>

<body>

    <?php
    if (isset($id)) {
        if ($_SESSION["array"][$id]["statu"] == 1) {?>
    <div class="container-fluid d-flex flex-rows p-0">
        <div class="side-bar  border-1 border-end  border-dark ">
            <div class="logo d-flex flex-column justify-content-center align-items-center gap-3 pt-2">
                <img class="logo-img" src="../favico.svg" alt="">
                <h6 class="logo-text"><b>SHOP PANEL</b></h6>
            </div>
            <div class="menu d-flex flex-column justify-content-space-between py-3 text-center">
                <li class="px-2">
                    <a href="<?=SITE?>index.php?sayfa=dashboard"
                        class="d-flex gap-2  justify-content-center align-items-center <?php echo ($activePage == "dashboard") ? 'active' : ''; ?>">
                        <span class="material-symbols-outlined">
                            Dashboard
                        </span>
                        <b class="menu-text ">Gösterge Paneli</b>
                    </a>
                </li>
                <li class="px-2">
                    <a href="<?=SITE?>index.php?sayfa=notification"
                        class="d-flex gap-2 justify-content-center align-items-center <?php echo ($activePage == "notification") ? 'active' : ''; ?>">
                        <span class="material-symbols-outlined">
                            notifications
                        </span>
                        <b class="menu-text">Duyurular</b>
                    </a>
                </li>
                <li class="px-2">
                    <a href="<?=SITE?>index.php?sayfa=mailbox"
                        class="d-flex gap-2 justify-content-center align-items-center <?php echo ($activePage == "mailbox") ? 'active' : ''; ?>">
                        <span class="material-symbols-outlined">
                            mail
                        </span>
                        <b class="menu-text">Mail Kutusu</b>
                    </a>
                </li>
                <li class="px-2">
                    <a href="<?=SITE?>index.php?sayfa=product"
                        class="d-flex gap-2 justify-content-center align-items-center <?php echo ($activePage == "product") ? 'active' : ''; ?>">
                        <span class="material-symbols-outlined">
                            inventory_2
                        </span>
                        <b class="menu-text">Ürünler</b>
                    </a>
                </li>
                <li class="px-2">
                    <a href="<?=SITE?>index.php?sayfa=members"
                        class="d-flex gap-2 justify-content-center align-items-center <?php echo ($activePage == "members") ? 'active' : ''; ?>">
                        <span class="material-symbols-outlined">
                            person
                        </span>
                        <b class="menu-text">Üyeler</b>
                    </a>
                </li>
                <li class="px-2">
                    <a href="<?=SITE?>index.php?sayfa=setting"
                        class="d-flex gap-2 justify-content-center align-items-center border-0 <?php echo ($activePage == "setting") ? 'active' : ''; ?>">
                        <span class="material-symbols-outlined">
                            settings
                        </span>
                        <b class="menu-text">Ayarlar</b>
                    </a>
                </li>
                
            </div>
        </div>
        <div class="container-fluid p-0">
            <div class="header px-2 border-1 border-bottom border-dark">
                <div class="menu-btn" onclick="toggleMenu()">
                    <span class="material-symbols-outlined">
                        menu
                    </span>
                </div>
                <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b><?php echo strtoupper($_SESSION["array"][$id]["adi"]. " " . $_SESSION["array"][$id]["soyad"]); ?></b>
                    </button>
                    <ul class="dropdown-menu text-center">
                        <li><a class="dropdown-item" href="../page/profile.php">Profil</a></li>
                        <li><a class="dropdown-item" href="../">Panel'den Çık</a></li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <?php 
                    if ($_GET && !empty($_GET["sayfa"])){
                        $sayfa = $_GET["sayfa"].".php";
                        if (file_exists(SAYFA.$sayfa))
                        {
                        include_once(SAYFA.$sayfa);
                        }
                        else{
                        include_once (SAYFA."error.php");
                        }
                        }
                        else
                        {
                        include_once (SAYFA."dashboard.php");
                        }
                        
                ?>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
    <script>
    var siteUrl = window.location.href;

    console.log(siteUrl);
    </script>

    <?php    
    } else {
    ?>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 84vh;">
        <div class="card p-5 d-flex justify-content-center align-items-center" style="min-height:24vh;">
            <div class="card-title text-center">
                <h1>
                    <b>
                        <font color="red">Bu sayfaya erişme yetkiniz yoktur!</font>
                    </b>
                </h1>
                <h5>
                    ( 5 saniye sonra anasayfaya yönlendiriliceksiniz )
                </h5>
            </div>
        </div>
    </div>

    <script>
    setTimeout(function() {
        window.location.href = '../index.php';
    }, 5000);
    </script>
    <?php
            exit; // Make sure to exit after the JavaScript redirection
        }
    } else {
        header("Location:../");
        exit; // Make sure to exit after the header redirection
    }
    ?>

</body>

</html>