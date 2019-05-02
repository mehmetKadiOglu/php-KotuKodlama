<?php
$host = "localhost";
$kullaniciAdi = "root";
$kullaniciSifre = "";
$veritabani = "proje";
$baglanti = mysqli_connect($host, $kullaniciAdi, $kullaniciSifre, $veritabani);
mysqli_error_list($baglanti);
mysqli_set_charset($baglanti,"utf8");
    
?>