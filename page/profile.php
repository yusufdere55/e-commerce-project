<?php
session_start();
@$usrid = $_SESSION["userid"];

include_once __DIR__ . "/../config/config.php";
$database = new Config("localhost", "root", "", "shop");
include_once('../shopping/php/component.php');

function site_url($url = null)
{
    return '/shop/page/' . $url;
}

$siteurl = site_url();

define("SAYFA", "profile/");
define("SITE", $siteurl);

$activePage = isset($_GET["sayfa"]) ? $_GET["sayfa"] : "dashboard";
if (isset($usrid)) {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo ucfirst($_SESSION["array"][$usrid]["adi"]) . " " . strtoupper($_SESSION["array"][$usrid]["soyad"]); ?>
    </title>
    <?php include __DIR__ . "../../include/link.php"; ?>
</head>

<body>
    <?php
        include "../include/header.php";

        ?>


    <div class="container py-5 " style="min-height: 500px; ">
        <div class="profile-box" style="min-height: 550px; border-radius: 25px;">
            <form action="../config/update.php" method="post" enctype="multipart/form-data">
            <div class="banner-box">
                <img src="<?php echo $_SESSION["array"][$usrid]["profile_banner"] ?>" class="img-fluid" alt="">
                <input style="display:none;"  name="BannerUpload" id="banner" class="form-control" accept="image/png" type="file" />
                    <label for="banner" class="profile_banner_plus">
                        <span class="material-symbols-outlined">add</span>
                    </label>
            </div>
            <div class="profile-photo">
                <img src="<?php echo $_SESSION["array"][$usrid]["profile_photo"] ?>" class="img-fluid" alt="">
                    <input style="display:none;" name="fileToUpload" id="dosya" class="form-control"
                        accept="image/png" type="file" />
                    <label for="dosya" class="profile_photo_plus">
                        <span class="material-symbols-outlined">add</span>
                    </label>
            </div>
            <div class="user-detais">
                <h2>

                    <?php echo ucfirst($_SESSION["array"][$usrid]["adi"])." ".strtoupper($_SESSION["array"][$usrid]["soyad"]); ?>

                </h2>
            </div>
            <div class="container-fluid pt-5 text-center d-flex flex-column justify-content-center">
                <div class="row w-100   ">
                    <ul class="nav nav-tabs d-flex justify-content-center w-100">
                        <li class="nav-item">
                            <a class="nav-link profile-menu  <?php echo ($activePage == "account") ? 'active' : '';  ?>"
                                href="<?=SITE?>profile.php?sayfa=account">Hesap</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link profile-menu  <?php echo ($activePage == "adress") ? 'active' : ''; ?>"
                                href="<?=SITE?>profile.php?sayfa=adress">Adress</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link profile-menu  <?php echo ($activePage == "order") ? 'active' : ''; ?>"
                                href="<?=SITE?>profile.php?sayfa=order">Siparişlerim</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link profile-menu  <?php echo ($activePage == "passwordchange") ? 'active' : ''; ?>"
                                href="<?=SITE?>profile.php?sayfa=passwordchange">Şifre Değiştir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link profile-menu  <?php echo ($activePage == "coupon") ? 'active' : ''; ?>"
                                href="<?=SITE?>profile.php?sayfa=coupon">İndirim Kuponlarım</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <?php 
                        if ($_GET && !empty($_GET["sayfa"])){
                            $sayfa = $_GET["sayfa"].".php";
                            if (file_exists(SAYFA.$sayfa)){
                                include_once(SAYFA.$sayfa);
                            }
                            else{
                                include_once (SAYFA."error.php");
                            }
                        }
                        else {
                            include_once (SAYFA."account.php");
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__."/../include/footer.php";?>
</body>

</html>
<?php
}
else{
    header("Location:../");
}
?>