<?php
session_start();
include_once __DIR__ . "/config/config.php";
$database = new Config("localhost", "root", "", "shop", "products");
include_once('shopping/php/component.php');
@$id = $_SESSION["userid"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php include __DIR__."/include/link.php"; ?>
</head>

<body>
    <form action="#" method="post">
        <div class="container py-5">
            <div class="row d-flex gap-3">
                <h1 class="text-center">Ürün ekle</h1>
                <input type="text" name="name" placeholder="Product name" id="">
                <input type="text" name="text" placeholder="Product text" id="">
                <input type="text" name="price" placeholder="Product price" id="">
                <input type="text" name="discount" placeholder="Product discount" id="">
                <input type="text" name="img" placeholder="Product img" id="">
                <input type="text" name="stock" placeholder="Product stock" id="">
                <select class="form-select" name="options" aria-label="Default select example">
                    <option selected>Category</option>
                    <option value="1">Computer</option>
                    <option value="2">Laptop</option>
                    <option value="3">Pc Component</option>
                </select>
                <input type="text" name="star" placeholder="Product star" id="">
                <button type="submit" name="btn" onclick="resetForm()">Ekle</button>
            </div>
        </div>
    </form>
    <?php 
    if(isset($_POST["btn"]))
    {
        $name = $_POST["name"];
        $text = $_POST["text"];
        $price = $_POST["price"];
        $discount = $_POST["discount"];
        $img = $_POST["img"];
        $stock = $_POST["stock"];
        $options = $_POST["options"];
        $star = $_POST["star"];

        $imgUrl = $img;

        $sql = "INSERT INTO products (productname, producttext, productprice, productdiscount, productimg, productstock, productcategory, productstar)
        VALUES ('$name', '$text', '$price', '$discount', '$img', '$stock', '$options', '$star')";
        $result = mysqli_query($database->conn,$sql);
        if($result)
        {
            echo "kayıt başarılı";
        }

        if($options == 1)
        {
            $targetDirectory = "C:/xampp/htdocs/shop/shopping/upload/computer/";
        }
        else if($options == 2) 
        {
            $targetDirectory = "C:/xampp/htdocs/shop/shopping/upload/laptop/";
        }
        else if($options == 3) 
        {
            $targetDirectory = "C:/xampp/htdocs/shop/shopping/upload/pc_component/";
        }
        $targetFileName = $targetDirectory . $name .".jpg";
        file_put_contents($targetFileName, file_get_contents($imgUrl));
        
        echo "Resim başarıyla kaydedildi: " . $targetFileName;
    }
    ?>
    <script>
    function resetForm() {
        document.getElementById("myForm").reset();
    }
    </script>
</body>

</html>
