<?php 
session_start();
session_destroy();

include_once "".__DIR__ ."/../config/config.php";
$database = new Config("localhost", "root", "", "shop");
include_once('../shopping/php/component.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <?php include __DIR__."../../include/link.php"; ?>
</head>

<body>
    <?php include "../include/header.php";?>
    <div class="container">
        <form action="http://localhost/shop/config/register.php" method="post">
            <div class="row text-center py-5 px-2 justify-content-center">
                <div class="card col-md-4 py-5 gap-3 px-5">
                    <h3 class="card-title">
                        <b>./</b> <small>Register Page</small>
                    </h3>
                    <div class="input-group gap-2">
                        <input type="text" name="name" class="form-control" placeholder="Name" required id="">
                        <input type="text" name="surname" class="form-control" placeholder="Surname" required id="">
                    </div>
                    <input type="email" name="mail" class="form-control" placeholder="E-Mail" required id="">
                    <input type="tel" name="phone" class="form-control" placeholder="+90()" pattern = "[0-9]+" required id="">
                    <small id="phoneError" style="color: red; display: none;"></small>
                    <input type="password" name="pwd" oninput="checkPasswords()" class="form-control" placeholder="Password" required id="pwd1">
                    <input type="password" name="pwd2" oninput="checkPasswords()" class="form-control" placeholder="Confirm Password" required id="pwd2">          
                    <?php 
                        if (isset($_COOKIE["message"])) {
                            // JavaScript kodunu içeren bir script etiketi ekleyerek tarayıcıda alert mesajını göster
                            echo '<script>alert("'.$_COOKIE["message"].'");</script>';
                        }
                    ?>
                    <small id="passwordError" style="color: red; display: none;"></small>
                    <button type="submit" name="btn" class="btn btn-success">Kayıt Ol</button>
                    <div class="register gap-2 d-flex justify-content-center">
                        <span>Mevcut hesabınız var mı?</span><a href="http://localhost/shop/page/login.php"
                            class="text-primary">Giriş Yap</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <?php include __DIR__."/../include/footer.php";?>
    <script>
        var phoneInput = document.querySelector('input[name="phone"]');
        var phoneError = document.getElementById('phoneError');

        phoneInput.addEventListener('input', function () {
            // Girilen değeri kontrol et
            if (!/^[0-9]*$/.test(phoneInput.value)) {
                phoneError.textContent = "Lütfen sadece sayı girin!";
                phoneError.style.display = "inline"; // Hata mesajını göster
            } else {
                phoneError.textContent = "";
                phoneError.style.display = "none"; // Hata mesajını gizle
            }
        });
    </script>
    <script>
        function checkPasswords() {
            var password1 = document.getElementById('pwd1').value;
            var password2 = document.getElementById('pwd2').value;
            var passwordError = document.getElementById('passwordError');

            if (password1 !== password2) {
                passwordError.textContent = "Passwords do not match!";
                passwordError.style.display = "inline";
            } else {
                passwordError.textContent = "";
                passwordError.style.display = "none";
            }
        }
    </script>
</body>

</html>