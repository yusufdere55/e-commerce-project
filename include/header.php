<?php ob_start(); ?>

<header>
    <nav class="navbar bg-body-tertiary pt-4">
        <div class="container-fluid px-5">
            <a class="navbar-brand text-warning" href="http://localhost/shop/"><i class="fa-solid fa-cart-shopping"></i>
                PC SHOP</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Ürün Adı" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="d-flex gap-3">
                <button type="button" class="btn position-relative sepet p-2">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <?php 
                        if(@$_SESSION["add"])
                        { ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        1
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    <?php }
                    ?>
                </button>
                <button type="button" class="btn position-relative sepet p-2 m-0">
                    <i class="fa-solid fa-heart"></i>
                </button>
                <a href="http://localhost/shop/page/notification.php">
                    <button type="button" class="btn position-relative bell p-2 m-0">
                        <i class="fa-solid fa-bell">
                            <?php
                        $startDate = date("Y-m-d", strtotime("-10 days"));
                        $endDate = date("Y-m-d");

                        $txtDosyaYolu = 'http://localhost/shop/page/notification/duyuru.txt';
                        $dosyaIcerik = file_get_contents($txtDosyaYolu);
                        $satirlar = explode("\n", $dosyaIcerik);
                        $duyuruBulundu = false;

                        foreach ($satirlar as $satir) {
                            if (strpos($satir, 'Date:') !== false) {
                                $tarihKismi = str_replace('Date:', '', $satir);
                                $tarih = trim($tarihKismi);

                                // Tarihi kontrol et
                                if ($tarih >= $startDate && $tarih <= $endDate) {
                                    echo '<span class="position-absolute  start-75 translate-middle p-1 bg-danger  rounded-circle"></span>';
                                    $duyuruBulundu = true;
                                    break; // Tarih bulunduğunda döngüden çık
                                }
                            }
                        }

                        if (!$duyuruBulundu) {
                            echo '';
                        }
                        ?>
                        </i>
                    </button>
                </a>
            </div>
        </div>
    </nav>
    <nav class="navbar my-0 bg-body-tertiary px-3 border-bottom border-dark-subtle">
        <ul class="nav  justify-content-center  ">
            <li class="nav-item">
                <a class="nav-link text-dark-emphasis" href="<?php echo category(1); ?>">Bilgisayar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark-emphasis" href="<?php echo category(2); ?>">Laptop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark-emphasis" href="<?php echo category(3); ?>">Bilgisayar Bileşenleri</a>
            </li>
            <li class="nav-item">
                <a href="#" class="text-dark-emphasis nav-link">Hakkımda</a>
            </li>
            <li class="nav-item">
                <a href="http://localhost/shop/page/contact.php" class="nav-link text-dark-emphasis">İletişim</a>
            </li>
        </ul>
        <?php 
                if(@$usrid)
                {?>
        <ul class="nav">
            <li class="nav-item dropdown text-center">
                <a class="nav-link dropdown-toggle text-dark-emphasis" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">

                    <?php echo  strtoupper( $_SESSION["array"][$usrid]["adi"] );?>
                </a>
                <ul class="dropdown-menu text-center" style="left:-50px;">
                    <li><a class="dropdown-item " href="http://localhost/shop/page/profile.php?sayfa=account">Profil</a>
                    </li>

                    <?php 
if(count($_SESSION["id_array"]) > 1)
{?>
                    <li><button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Hesap Değiştir
                        </button>



                    </li>
                    <?php }
                    if($_SESSION["array"][$usrid]["statu"]==1)
                    {
?>
                    <li><a class="dropdown-item" href="http://localhost/shop/shop-panel">Admin Panel</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item" href="http://localhost/shop/page/login.php">Hesap Ekle</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="http://localhost/shop/page/logout.php">Çıkış Yap</a></li>

                </ul>
            </li>
        </ul>
        <?php }
            else{?>
        <ul class="nav d-flex justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/shop/page/login.php">Giriş Yap</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/shop/page/register.php">Kayıt Ol</a>
            </li>
        </ul>
        <?php 

            }
            ?>
    </nav>
</header>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hesap Değiştir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="change d-flex flex-column gap-2">
                    <?php
    foreach ($_SESSION["id_array"] as $id) {
        echo '<a href="http://localhost/shop/config/changeuser.php?id=' . $id . '">';
        echo '<span ' . ($_SESSION["userid"] == $id ? 'style="color:red;"' : '') . '>';
        echo ($_SESSION["userid"] != $id ? '>' : '&nbsp&nbsp&nbsp'). ucfirst($_SESSION["array"][$id]["adi"])." ".strtoupper($_SESSION["array"][$id]["soyad"]) ;
        echo '</span>';
        echo '</a>';
    }
    ?>
                </div>
            </div>

        </div>
    </div>
</div>