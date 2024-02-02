<?php 
session_start();

@$usrid = $_SESSION["userid"];
include_once __DIR__ ."/../config/config.php";
$database = new Config("localhost", "root", "", "shop");
include_once('../shopping/php/component.php');
$product_id = isset($_GET['id']) ? $_GET['id'] : null;
if ($product_id !== null && is_numeric($product_id)) {
    $query = "SELECT * FROM products WHERE productid = $product_id";
    $result = mysqli_query($database->conn, $query);
    $row = mysqli_fetch_assoc($result);
    $category_id = array (
        "categoryid" => $row["productcategory"]
    );

    $categoryname = "SELECT * FROM category";
    $calistir = mysqli_query($database->conn,$categoryname);
    
while ($catename = mysqli_fetch_assoc($calistir)) {
    
    $currentCategoryId = $catename["id"];
    $categoryid[] = $currentCategoryId;
    $categoryname = $catename["name"];

    if ($currentCategoryId == $category_id["categoryid"]) {
         $name =$categoryname;// Ekrana yazdırma işlemi
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row["productname"]; ?></title>
    <?php include __DIR__."../../include/link.php"; ?>

</head>

<body>
    <?php include "../include/header.php";

        if ($row > 0) {
    ?>
    <div class="container ">
        <div class="row px-1 pt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://localhost/shop/">Anasayfa</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo category($category_id["categoryid"]); ?>"><?php 
                        echo $name;
                    ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"> <?php echo $row['productname'];?></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="card my-0">
                <div class="row g-0">
                    <div class="col-md-4 p-4  d-flex justify-content-center">
                        <img src="<?php echo $row["productimg"]; ?>" class="img-fluid  w-100 mx-auto" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body d-flex flex-column justify-content-between pt-4 pb-5" style="height:100%">
                            <h5 class="card-title"> <?php echo $row['productname']." ".$row['producttext'];?></h5>
                            <h4>
                                <?php 
                                    if($row['productstar'] <5)
                                    {
                                        $nullstar = 5 - $row["productstar"];
                                        $sayac = 0 ;
                                        while($sayac<$row["productstar"])
                                        {
                                            $sayac ++;
                                            echo '<i class="fa-solid fa-star"></i>';
                                        }
                                        $sayac = 0;
                                        if($nullstar > 0)
                                        {
                                            while($sayac < $nullstar)
                                            {
                                                $sayac++;
                                                echo '<i class="fa-regular fa-star"></i>';
                                            }    
                                        }
                                    }
                                    else{
                                        $sayac = 0;
                                        while($sayac<5)
                                        {
                                            $sayac++;
                                            echo '<i class="fa-solid fa-star"></i>';
                                        }
                                    }
                                ?>
                            </h4>
                            <h5 class="my-2">
                                <?php 
                                    if($row["productdiscount"] > 0)
                                    {   $oldprice = number_format($row["productprice"], 2, ',', '.');
                                        echo "<small><s>".$oldprice."₺</s></small>&nbsp&nbsp";
                                        $newprice = $row["productprice"] - ($row["productprice"] * $row["productdiscount"] / 100);
                                        $formattedPrice = number_format($newprice, 2, ',', '.');
                                        echo "<span class='price detais-price'>".$formattedPrice."₺</span>";
                                    }
                                    else {
                                        $oldprice = number_format($row["productprice"], 2, ',', '.'); 
                                        ?>
                                <span class="price detais-price"><?php echo $oldprice?>₺</span>
                                <?php }
                                
                                ?>
                            </h5>

                            <div class="add-btn d-flex">
                                <form action="#" method="post">
                                    <button type="button" id="liveToastBtn"
                                        class="btn btn-warning position-relative p-2 m-0" " name=" add">Add to Card <i
                                            class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                    <button type="button" class="btn position-relative btn-danger p-2 px-3 m-0">
                                        <i class="fa-solid text-white fa-heart"></i>
                                    </button>
                                    <div class="toast-container position-fixed bottom-0 end-0 p-3">
                                        <div id="liveToast" class="toast" role="alert" aria-live="assertive"
                                            aria-atomic="true">
                                            <div class="toast-header">
                                                <img src="http://localhost/shop/favico.svg" class="rounded me-2"
                                                    alt="...">
                                                <strong class="me-auto">Shopping Card</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="toast"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="toast-body">
                                                Sepete Eklendi
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php
        if ($row["productcategory"] == 1) {
            $parcalar = $row["productfeature"];
            $urun_idleri_dizisi = explode(",", $parcalar);
        ?>

        <div class="row my-5">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Sistemde kullanılan parçalar
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php
                // $urun_idleri_dizisi kullanılmalı
                $sayac  = 0;
                foreach ($urun_idleri_dizisi as $urunid) {
                    
                    $result = $database->getSearch("products", "productid", $urunid);

                   
                        if ($result && $result->num_rows > 0) {
                            $product = mysqli_fetch_assoc($result);
                            if($urun_idleri_dizisi[$sayac] == $product["productid"])
                            { ?>
                            <!-- echo $product["productname"];
                                echo "  ".$product["productid"]; -->
                            <div class="parcalar d-flex mb-3">
                                <div class="parcalar-img">
                                    <img src="<?php echo $product['productimg']; ?>"
                                        class="border-0 text-center img-thumbnail" alt="...">
                                </div>
                                <div class="parcalar-title">
                                    <?php echo $product["productname"]." ".$product["producttext"] ?>
                                </div>
                            </div>

                            <div class="col-10"></div>
                            <?php }
                            
                        } else {
                            echo "<div class='text-center'>Sistemde kullanılan parçalar henüz eklenmedi!</div>";
                        }
                   $sayac = $sayac + 1;                   
                }
                ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php
        }
        ?>


        <div class="row mt-5 ">
            <div class="col-12 border-bottom border-2 border-dark">
                <h2 class="px-3">Benzer Ürünler</h2>
            </div>
        </div>
        <div class="row similar-products mt-2 px-4 ">
            <?php
               $reuslt1 = $database->getData();
               $remainingProducts = array();

                while ($row = mysqli_fetch_assoc($reuslt1)) {
                    $benzer = abs($row["productid"] - $product_id);
                
                    // Check if the productid matches
                    if ($benzer !== 0) {
                        // If not matching, add to the remaining products array
                        $remainingProducts[] = $row;
                    }
                }
                
                // Print the remaining products
                foreach ($remainingProducts as $product) { 
                    if ($product["productcategory"] == $category_id["categoryid"]) {?>
            <div class="card" style="width: 18rem;">
                <a href="../../shop/page/detais.php?id=<?php echo $product["productid"]; ?>" class="card-fix"><img
                        src="<?php echo $product["productimg"] ?>" class="card-img-top p-4" alt="...">
                    <div class="card-body">
                        <h5 class="card-title card-title-short"><?php echo $product["productname"] ?></h5>
                </a>

            </div>
        </div>
        <?php }}
            ?>
    </div>

    </div>
    <div class="container my-5"></div>
    <?php include __DIR__."/../include/footer.php";?>
    <script>
    const toastTrigger = document.getElementById('liveToastBtn')
    const toastLiveExample = document.getElementById('liveToast')

    if (toastTrigger) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastTrigger.addEventListener('click', () => {
            toastBootstrap.show()
        })
    }
    </script>

</body>

</html>
<?php   // Veritabanından ürün bilgilerini çek
        

        // Veritabanından çekilen bilgileri kullanarak sayfayı oluştur
        
            
            // Diğer bilgileri ekleyin
        } else {
            echo "Ürün bulunamadı";
        }
    } else {
        echo "Geçersiz ürün ID";
    }