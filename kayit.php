<!DOCTYPE html>
<html lag="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css/header.css">
<title>Document</title>

<style>
.gel td{

    padding-top: 20px;
}   
</style>
</head>
<?php include 'header.php'; ?>


    <div style="margin-left: 11%;width: 68%;margin-top:7%;">
        <?php
            if(isset($_GET["sn"]))
            {
                if($_GET["sn"]==1) echo "Şifreniz Uyuşmuyor";
                else if($_GET["sn"]==2) echo "Lütfen Mailinizi Kontrol Ediniz";
                else echo "Bu Maille Kayıt Mevcuttur";
            }
        ?>   
        <form action="sinif.php" method="POST">
            <table class="gel" style="width:600px;margin-top:20px;">
                <tr>
                    <td>Adı</td>
                    <td>:&nbsp;&nbsp;&nbsp;<input type="text" name="adi" id=""></td>   
                </tr>
                <tr>
                    <td>Soyadı</td>
                    <td>:&nbsp;&nbsp;&nbsp;<input type="text" name="soyadi" id=""></td>   
                </tr>
                <tr>
                    <td>Mail</td>
                    <td>:&nbsp;&nbsp;&nbsp;<input type="mail" name="mail" id=""></td>   
                </tr>
                <tr>
                    <td>Şifre</td>
                    <td>:&nbsp;&nbsp;&nbsp;<input type="password" name="sifre" id=""></td> 
                </tr>
                <tr>
                    <td>Şifre Tekrarı</td>
                    <td>:&nbsp;&nbsp;&nbsp;<input type="password" name="sifre2" id=""></td> 
                </tr>
                <tr>
                    <td>Cinsiyet</td>
                    <td>:&nbsp;&nbsp;&nbsp;<input type="radio" name="cinsiyet" value="Erkek"> Erkek &nbsp; <input type="radio" name="cinsiyet" value="Kadın"> Kadın</td> 
                </tr>

                <tr>
                    <td>Telefon Numarası</td>
                    <td>:&nbsp;&nbsp;&nbsp;<input type="tel"  maxlength="10" name="tel" id=""></td> 
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Kaydet" name="kaydol"></td> 
                </tr>
            </table>
        </form>
    </div>     

</body>
</html>