<header>
    <nav class="navbar bg-body-tertiary pt-4">
        <div class="container-fluid px-5">
            <a class="navbar-brand" href="http://localhost/shop/"><i class="fa-solid fa-cart-shopping"></i> PC SHOP</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
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
            </div>
        </div>
    </nav>
    <nav class="navbar my-0 bg-body-tertiary px-3 border-bottom border-dark-subtle">
        <ul class="nav  justify-content-center ">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo category(1); ?>">Computer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo category(2); ?>">Laptop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo category(3); ?>">Pc Component</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">About Us</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
        <?php 
                if(@$id)
                {?>
        <ul class="nav">
            <li class="nav-item dropdown text-center">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <?php echo  strtoupper( $_SESSION["array"][$id]["adi"] );?>
                </a>
                <ul class="dropdown-menu text-center" style="left:-50px;">
                    <li><a class="dropdown-item" href="#">Profile</a></li>

                    <?php 
if(count($_SESSION["id_array"]) > 1)
{?>
                    <li><a href="" class="dropdown-item">Hesap Değiştir</a></li>
                    <?php }
?>
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
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/shop/page/login.php">Login</a>
            </li>
        </ul>
        <?php 

            }
            ?>
    </nav>
</header>