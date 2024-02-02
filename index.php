<?php
session_start();
include_once __DIR__ ."/config/config.php";
$database = new Config("localhost", "root", "", "shop", "products");
include_once('shopping/php/component.php');
@$usrid = $_SESSION["userid"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC SHOP</title>
    <?php include __DIR__."/include/link.php"; ?>
</head>

<body>
    <?php include __DIR__."/include/header.php"; ?>
    <div class="container-fluid">
        <div class="row text-center bg-danger">
            <marquee behavior="" scrollamount="20" class="px-5  py-2" direction="right"><a
                    href="http://localhost/shop/page/list.php" class="text-light"
                    style="letter-spacing: 1.5px;font-style:italic;">
                    En ucuz ilk 12 ürünü görmek için tıklayın!
                </a></marquee>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row text-center py-5 px-5">
            <?php 
                $reuslt = $database->getDataRand();
                while($row =mysqli_fetch_assoc($reuslt))
                {
                    component($row["productid"],$row["productimg"],$row["productname"],$row["productprice"],$row["productdiscount"],$row["productstar"]);
                }
            ?>

        </div>
    </div>
    <?php include __DIR__."/include/footer.php";?>
    <script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
    </script>
    <?php if (isset($_COOKIE["logerror"])) { 
        
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        
        ?>
<script>
    alert("<?php if (isset($_COOKIE["logerror"])) { echo $_COOKIE["logerror"] . '\nHoşgeldiniz: ' . $_SESSION["array"][$usrid]["adi"].'\nId:'. $ipAddress ; } ?>");
</script>
<?php } ?>
</body>

</html>