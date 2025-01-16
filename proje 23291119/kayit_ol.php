<?php
$servername = "localhost";
$username = "root";         
$password = "";              
$dbname = "kullanici_db";    


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}


$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);


$conn->query("CREATE TABLE IF NOT EXISTS kullanicilar (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ad VARCHAR(50) NOT NULL,
    soyad VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    sifre VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $conn->real_escape_string($_POST['ad']);
    $soyad = $conn->real_escape_string($_POST['soyad']);
    $email = $conn->real_escape_string($_POST['email']);
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT); 

    
    $sql = "INSERT INTO kullanicilar (ad, soyad, email, sifre) VALUES ('$ad', '$soyad', '$email', '$sifre')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Kayıt başarılı bir şekilde oluşturuldu!</p>";
    } else {
        echo "<p>Hata: " . $conn->error . "</p>";
    }
}


$conn->close();
?>
