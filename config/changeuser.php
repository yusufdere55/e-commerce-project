<?php
session_start();
@$usrid = $_SESSION["userid"];
if ($id = @$_GET["id"]) {
    $_SESSION["userid"] = $id;
    header("Location:http://localhost/shop/");
}