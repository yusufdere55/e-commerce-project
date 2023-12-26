<?php
session_start();
@$id = $_SESSION["userid"];
include_once "".__DIR__ ."/../config/config.php";
$database = new Config("localhost", "root", "", "shop");
include_once('../shopping/php/component.php');

$list = $database->getCostumDataAsc("products","productprice");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include __DIR__."../../include/link.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <?php include "../include/header.php";?>
    <div class="container-fluid">
        <div class="row text-center py-5 px-5">
            <?php 
            while($row =mysqli_fetch_assoc($list))
            {
                component($row["productid"],$row["productimg"],$row["productname"],$row["productprice"],$row["productdiscount"],$row["productstar"]);
                            
            }
            ?>
        </div>
    </div>
</body>

</html>