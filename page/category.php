<?php 
session_start();
@$id = $_SESSION["userid"];
include_once "".__DIR__ ."/../config/config.php";
$database = new Config("localhost", "root", "", "shop","products");
include_once('../shopping/php/component.php');
$category_id = isset($_GET['categoryid']) ? $_GET['categoryid'] : null;
if ($category_id !== null && is_numeric($category_id)) {
    $query = "SELECT * FROM category WHERE id = $category_id";
    $result = mysqli_query($database->conn, $query);
    $row = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row["name"]; ?>s </title>
    <?php include __DIR__."../../include/link.php"; ?>
</head>

<body>
    <?php include "../include/header.php";?>
    <div class="container">
        <div class="row text-center py-5">
            <?php 
                $reuslt = $database->getData();
                // İlk satırı oku
                $row = mysqli_fetch_assoc($reuslt);
                
                while ($row !== null) {
                    if ($row["productcategory"] == $category_id) {
                        // Eğer productcategory category_id'ye eşitse, verileri ekrana yazdır
                        component($row["productid"], $row["productimg"], $row["productname"], $row["productprice"], $row["productdiscount"], $row["productstar"],$row["producttime"]);
                    }
                
                    // Sonraki satırı oku
                    $row = mysqli_fetch_assoc($reuslt);
                }

                
                
            }
            ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>