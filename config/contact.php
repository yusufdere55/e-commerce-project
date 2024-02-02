<?php
session_start();

include_once "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';    

if (isset($_POST["mail-btn"])) {
    $kadi = isset($_POST["ad"]) ? $_POST["ad"] : "";
    $eposta = isset($_POST["mail"]) ? $_POST["mail"] : "";
    $konu = isset($_POST["konu"]) ? $_POST["konu"] : "";
    $msj = isset($_POST["mesaj"]) ? $_POST["mesaj"] : "";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'yusuf55dere@gmail.com';
    $mail->Password = 'dzbr yugu uywo uxqn';
    $mail->SetFrom($mail->Username, 'Shop.Admin');
    $mail->AddAddress($eposta, $kadi);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $konu;
    $mail->MsgHTML($msj);

    if ($mail->Send()) {
        $errorMsj = 'Mail gönderildi!';
        setcookie ("mailerror" , $errorMsj , time() + 5 , "/" );
        header("Location:../page/contact.php");
    } else {
        echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
    }
} else {
    header("Location:../page/contact.php");
}
?>
