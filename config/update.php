<?php
session_start();
@$usrid = $_SESSION["userid"];
include_once "config.php";

$database = new Config("localhost", "root", "", "shop");

if (isset($_POST["profilebtn"])) {
    $pwd = $_POST["password"];
    $pwdagain = $_POST["passwordagain"];

    if ($pwd == $pwdagain) {
        $sql = "SELECT * FROM users WHERE userpwd = '$pwd' ";
        $query = mysqli_query($database->conn, $sql);
        if (mysqli_num_rows($query)) {
            $ad = $_POST["name"];
            $soyad = $_POST["surname"];
            $mail = $_POST["mail"];
            $tel = $_POST["tel"];

            // Tarihi MySQL için doğru formatta oluşturun (YYYY-MM-DD)
            $date = $_POST["dyear"] . "-" . str_pad($_POST["dmount"], 2, "0", STR_PAD_LEFT) . "-" . str_pad($_POST["dday"], 2, "0", STR_PAD_LEFT);

            $userid = $_SESSION["array"][$usrid]["id"];
            $imageMimeType = ""; 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $targetDir = "C:/xampp/htdocs/shop/user/profile-photo/";  // Resimlerin kaydedileceği klasör
                $targetDir1 = "C:/xampp/htdocs/shop/user/profile-banner/";  // Resimlerin kaydedileceği klasör
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];        
                $photoExtension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
                $targetFile = $targetDir . $_POST["name"] . $_POST["surname"] . $userid ."photo" . "." . $photoExtension;
                
                $bannerExtension = pathinfo($_FILES["BannerUpload"]["name"], PATHINFO_EXTENSION);
                $targetFile1 = $targetDir1 . $_POST["name"] . $_POST["surname"] . $userid ."banner" . "." . $bannerExtension;
                


                $uploadOk = 1;


                echo $targetFile ."<br>". $targetFile1;


                // Dosyanın bir resim olup olmadığını kontrol et

                if (!empty($_FILES["fileToUpload"]["tmp_name"]) && file_exists($_FILES["fileToUpload"]["tmp_name"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    $imageMimeType = $check['mime'];

                    if ($check === false) {
                        echo "Seçilen dosya bir resim değil.";
                        $uploadOk = 0;
                    }
                    // Diğer kodlar...
                } else {
                    echo "Profile Fotoğrafı dosyası yüklenmedi veya boş.";
                    $uploadOk = 0;
                }

                if (!empty($_FILES["BannerUpload"]["tmp_name"]) && file_exists($_FILES["BannerUpload"]["tmp_name"])) {
                    $check1 = getimagesize($_FILES["BannerUpload"]["tmp_name"]);
                    $imageMimeType1 = $check1['mime'];

                    if ($check1 === false) {
                        echo "Seçilen dosya bir resim değil.";
                        $uploadOk = 0;
                    }
                    // Diğer kodlar...
                } else {
                    echo "Banner dosyası yüklenmedi veya boş.";
                    $uploadOk = 0;
                }
            }

            // Dosya zaten varsa kontrol et
            if (file_exists($targetFile)) {
                if (unlink($targetFile)) {
                    echo "Dosya başarıyla silindi.";
                } else {
                    echo "Dosya silinirken bir hata oluştu.";
                }
                $uploadOk = 1;
            }

            if (file_exists($targetFile1)) {
                if (unlink($targetFile1)) {
                    echo "Dosya başarıyla silindi.";
                } else {
                    echo "Dosya silinirken bir hata oluştu.";
                }
                $uploadOk = 1;
            }

            // Dosya boyutunu kontrol et
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "Üzgünüz, dosya boyutu çok büyük.";
                $uploadOk = 0;
            }
            if ($_FILES["BannerUpload"]["size"] > 5000000) {
                echo "Üzgünüz, dosya boyutu çok büyük.";
                $uploadOk = 0;
            }

            // Belirli dosya türlerine izin ver
            if (!in_array($photoExtension, $allowedExtensions) || !in_array($bannerExtension, $allowedExtensions)) {
                echo "Üzgünüz, sadece JPG, JPEG, PNG ve GIF dosyalarına izin verilir.";
                $uploadOk = 0;
            }
            if (!in_array($photoExtension, $allowedExtensions) || !in_array($bannerExtension, $allowedExtensions)) {
                echo "Üzgünüz, sadece JPG, JPEG, PNG ve GIF dosyalarına izin verilir.";
                $uploadOk = 0;
            }

            // Hata olup olmadığını kontrol et ve dosyayı yükle
            if ($uploadOk == 0) {
                echo "Üzgünüz, dosyanız yüklenemedi.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                    // Resmi belirli boyutlara getir
                    $imageMimeType = getimagesize($targetFile)['mime'];

                    if ($imageMimeType === 'image/jpeg') {
                        resizeImage($targetFile, 1000, 1000); // JPEG dosyasıysa boyutlandır
                    }
                    echo "Dosya başarıyla yüklendi ve boyutları ayarlandı.";
                } else {
                    echo "Üzgünüz, dosya yüklenirken bir hata oluştu.";
                }
                if (move_uploaded_file($_FILES["BannerUpload"]["tmp_name"], $targetFile1)) {
                    // Resmi belirli boyutlara getir
                    $imageMimeType1 = getimagesize($targetFile)['mime'];

                    if ($imageMimeType1 === 'image/jpeg') {
                        resizeImage($targetFile1, 1000, 500); // JPEG dosyasıysa boyutlandır
                    }
                    echo "Dosya başarıyla yüklendi ve boyutları ayarlandı.";
                } else {
                    echo "Üzgünüz, dosya yüklenirken bir hata oluştu.";
                }
            }

            $pp = "http://localhost/shop/user/profile-photo/" . $_POST["name"] . $_POST["surname"] . $usrid . "photo.png";
            $banner = "http://localhost/shop/user/profile-banner/" . $_POST["name"] . $_POST["surname"] . $usrid . "banner.png";

            $sql1 = "UPDATE users SET username = '$ad', usersurname = '$soyad', usermail = '$mail', userphone = '$tel', userDate = '$date', userphoto = '$pp', userBanner = '$banner' WHERE id = '$userid'";

            $result = mysqli_query($database->conn, $sql1);

            if ($result) {
                $error = "Güncellendi";
            } else {
                $error = "Güncelleme hatası: " . mysqli_error($database->conn);
            }

            setcookie("error", $error, time() + 5, "/");
            #header("Location:http://localhost/shop/page/profile.php?sayfa=account");
        } else {
            $error = "Şifre Yanlış";
            setcookie("error", $error, time() + 5, "/");
            header("Location:http://localhost/shop/page/profile.php?sayfa=account");
        }
    } else {
        $error = "Şifre Eşleşmiyor";
        setcookie("error", $error, time() + 5, "/");
        header("Location:http://localhost/shop/page/profile.php?sayfa=account");
    }
}

function resizeImage($filename, $newWidth, $newHeight)
{
    list($width, $height) = getimagesize($filename);
    $originalImage = imagecreatefromjpeg($filename);
    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagejpeg($resizedImage, $filename);
    imagedestroy($originalImage);
    imagedestroy($resizedImage);
}
?>
