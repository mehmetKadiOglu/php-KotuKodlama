<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/urun_satis.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/urun_sayfa.css">
    <link rel="stylesheet" href="css/sepet.css">
</head>

<body>
    <div class="header">
        <div style="width: 100%;height: 41.76px;border-bottom: 1px solid #55595f;"  >
            <div class="üst_header" >
                <div class="üst_link">
                    <a href="">Hakkımızda</a>
                    <a href="">Besinpara</a>
                    <a href="">Kargo Takibi</a>
                    <a href="">İletişim</a> 
                </div>
        
                <div class="iconlar" > 
                    <span > Müşteri Hizmetleri : 0850 346 83 90</span>
                    <div class="banner">
                        <img src="image/banner_1.png" alt="">
                        <img src="image/banner_2.png" alt="">
                        <img src="image/banner_3.png" alt="">
                    </div>
                </div>
            </div>
        </div>  
        
        <div class="alt_header" >
            <div class="sayfa_resimi" onclick="location.href='index.php'" ></div>
            <div class="form">
                <input class="text" type="text" placeholder="Aramak istediğiniz ürünün adını yazınız" >
                <div class="arama_kutusu">
                    <input  style="background-image: url('image/magnifying-308995_960_720.png'); background-size: 50% 50%;" type="submit" name="Submit" value="">                            
                </div>

                <div class="hesapp">
                    <ul>
                    <?php

                        include 'baglanti.php'; 
                        session_start();

                        if(isset($_SESSION["Kullanici"]) || isset($_SESSION["admin"]) )
                            echo "<li>  Hesabım</li><li>";
                        else     
                            echo "<li> Üye Giriş</li><li>";
                        
                        if(isset($_GET["mesaj"]))
                            echo '<div class=uye_giris style=display:block;> <b><center>Mail adresiniz veya şifreniz hatalı</center></b><br>';

                        else echo '<div class="uye_giris">';

                        if(isset($_SESSION["Kullanici"]))
                        {
                            echo 'SN. '.$_SESSION["Kullanici"]["1"].
                            '<form action="sinif.php" method="post">
                                <input type=submit name=cikis value=Cıkış&nbsp;Yap>
                            </form></div>';
                        }
                        else if(isset($_SESSION["admin"]))
                        {
                            echo 'SN. '.$_SESSION["admin"]["1"]. '
                                <form action="sinif.php" method="post">
                                    <input type=submit name=cikis value=Cıkış&nbsp;Yap/>
                                </form></div>';
                        }
                        else
                        {
                        ?>
                                <b class="b">KULLANICI GİRİŞİ</b>
                                <a class="a">Üye girişi yaparak alışverişin doyasıya keyfini çıkarın</a>
                                <form action="sinif.php" method="post">
                                    <div class="mail">
                                        <?php
                                            if(isset($_COOKIE['KullaniciGiris']))
                                                echo'<input  class=text type=text style=width:88%; name=mail value='.$_COOKIE["KullaniciGiris"].'>';
                                            else 
                                                echo'<input  class="text" type="text" style=width:88%; placeholder=Mail&nbsp;Giriniz name=mail>';
                                        ?>   
                                    </div>

                                    <div style="margin-top: -2%;" class="mail">
                                        <input class="text" type="password" style="width: 88%;" placeholder="Şifre Giriniz" name="sifre" >   
                                    </div>

                                    <div  class="mail">
                                        <input class="text" style="background-color:#49af11;color:white;" type="submit" name="giris" value="GİRİŞ" > 
                                        <label style="margin-left:3%"><input type="checkbox" name="onay"> Beni Hatırla</label>
                                    </div>
                                </form>
                                <span ><center> Henüz Üye Değilmisiniz ?</center></span>
                                <a href="kayit.php" class="kayit">  Şimdi tıklayın ve kaydolun!</a>
                            <?php echo '</div>'; }  ?>  
                            
                          
                        </li>
                    </ul>
                </div>
                <div class="sepet"  onclick="location.href='sepet.php'">
                    <?php   
                        if(isset($_COOKIE["sepetim"])) echo '<span>'.count($_COOKIE["sepetim"]).'</span>';
                           
                        else echo '<span> 0 </span>';

                    ?>

                    <a>Sepetim</a>
                </div>
            </div><!-- form divi -->
        </div><!-- alt_header divi -->
    </div>  <!-- header divi -->

    <div id="menü">
        <span class="Katagori">
            <ul>
                <li> 
                    <a href="">Tüm Katagoriler</a>
                </li>
                <li>
                    <div class="Genel_acilir"> 
                        <div class="ic_acilir">
                            <ul>
                                <li id="protein_li"><b> Protein Tozu</b>
                                    <ul>
                                        <div class="protein_acilir">
                                            <span> </span>                                                
                                            <li>Whey Protein </li>
                                            <li>İzole Protein</li>
                                            <li> Kompleks Protein</li>
                                            <li> Protein Bar</li>
                                            <li> Kazein (Süt Proteini) </li>
                                            <li> Et Proteini</li>
                                            <li> Protein Shake</li>
                                            <li> Soya Proteini</li>       
                                        </div> 
                                    </ul>                                
                                </li>

                                <li id="amino_li"><b>Amino Asit </b>
                                    <ul>
                                        <div class="amino_acilir" >
                                            <span> </span>                                                
                                            <li> BCAA </li>
                                            <li> Kompleks Amino Asit</li>
                                            <li>  Glutamin</li>
                                            <li>  Arjinin</li>
                                            <li>  Likit Amino Asit </li>
                                            <li>  AOL</li>
                                        </div> 
                                    </ul>                                
                                </li>

                                <li><b>Kilo ve Hacim </b>
                                </li>
                                <li id="karnitin_li"><b>L-Karnitin ve CLA</b>
                                    <ul>
                                        <div class="karnitin_acilir" >
                                            <span> </span>                                                
                                            <li>  Karnitin (L-Carnitine) </li>
                                            <li>  Termojenik</li>
                                            <li>   CLA</li>
                                            <li>   Hazır İçecek </li>
                                            <li>   Diğer Diyet Ürünleri </li>     
                                        </div> 
                                    </ul>                   
                                </li>

                                <li id="kreatin_li"><b>Kreatin </b>
                                    <ul>
                                        <div class="kreatin_acilir" >
                                            <span> </span>                                                
                                            <li>   Kreatin Monohidrat </li>
                                            <li>   Kompleks Kreatin</li>       
                                        </div> 
                                    </ul>                   
                                </li>

                                <li id="performans_li"> <b>Performans ve Güç</b>
                                    <ul>
                                        <div class="performans_acilir" >
                                            <span> </span>                                                
                                            <li>   Güç ve Performans </li>
                                            <li>   Enerji ve Dayanıklılık</li>
                                            <li>    Karbonhidrat ve Jel </li>
                                            <li>    Tribulus </li>
                                            <li>    Kompleks Testosteron </li>              
                                        </div> 
                                    </ul> 
                                </li>
                                <li><b>Paketler</b></li>
                                <li><b>Tatlandırıcılar</b></li>
                            </ul>
                        </div>
                    </div>
                </li>  
            </ul> 
        </span> <!--katagori spanı -->

        <div class="Ürün_Çeşitleri">
            <div class="liste">
                <ul >
                   <!-- <li><a href="protein.php"> Protein Tozu </a></li> 
                    <li><a href="Amino_Asit.php">Amino Asit </a></li>
                    <li><a href="kilo_hacim.php">Kilo ve Hacim </a></li>
                    <li><a href="karnitin_cla.php">L-Karnitin ve CLA </a> </li>
                    <li><a href="kreatin.php">Kreatin </a></li>
                    <li><a href="performans_güç.php">Performans ve Güç </a></li>
                    <li><a href="paketler.php">Paketler </a></li>
                    <li><a href="tatlandırıcılar.php">Tatlandırıcılar </a></li>

                    -->
                    <li><a href="protein.php?tur=Protein"> Protein Tozu </a></li> 
                    <li><a href="protein.php?tur=Amino Asit">Amino Asit </a></li>
                    <li><a href="protein.php?tur=Kilo ve Hacim">Kilo ve Hacim </a></li>
                    <li><a href="protein.php?tur=L-Karnitin ve CLA">L-Karnitin ve CLA </a> </li>
                    <li><a href="protein.php?tur=Kreatin">Kreatin </a></li>
                    <li><a href="protein.php?tur=Performans ve Güç">Performans ve Güç </a></li>
                    <li><a href="protein.php?tur=Paketler">Paketler </a></li>
                    <li><a href="protein.php?tur=Tatlandırıcılar">Tatlandırıcılar </a></li>
                </ul>
            </div>

            <div class="Marka" >
                <ul>
                    <li>
                        <a href=""> Markalar </a>  
                    </li>
                    <li>
                        <div class="acılır2"> sadsakdslakdjlska  </div>
                    </li>  
                </ul>                
            </div>
        </div>     
    </div><!-- menu-->