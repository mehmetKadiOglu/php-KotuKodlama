<?php include_once('baglanti.php');


////////////////////////////////////////////////////////////////////////////////
// Müsteri Kayıt islem Baslangıc
if(isset($_POST["kaydol"])) 
{
    $array= array("admin","admn","admin","sporcu besinleri","sprcu bsnlr","sporcu besnleri","sporc besnlri","sprc besinleri");
    $kullaniciAd=ucwords($_POST["adi"]);
    $kullaniciSoyad=ucwords($_POST["soyadi"]);
    $kullaniciMail=$_POST["mail"];
    $kullaniciSifre1=md5($_POST["sifre"]);
    $kullaniciSifre2=md5($_POST["sifre2"]);
    $kullaniciCinsiyet=$_POST["cinsiyet"];
    $kullaniciTelefon=$_POST["tel"];
    $kontrol=mb_strtolower($kullaniciAd.' '.$kullaniciSoyad);

    foreach ($array as $key) {
        if(strstr($kontrol, $key)) 
        header("location:kayit.php?sn=2");
    }

    if($kullaniciSifre1!== $kullaniciSifre2 ) header("location:kayit.php?sn=1");
    else if(!filter_var($kullaniciMail, FILTER_VALIDATE_EMAIL))  header("location:kayit.php?sn=2");
    else
    {
        $sorgu="INSERT INTO musteriler values ('$kullaniciAd','$kullaniciSoyad', '$kullaniciSifre1','$kullaniciMail',$kullaniciTelefon, '$kullaniciCinsiyet' )";
        $sonuc=mysqli_query($baglanti,$sorgu);
        mysqli_close($baglanti);
        if(!$sonuc) header("location:kayit.php?sn=3");
        else{ ?>
        <
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="css/header.css">
            <title>Document</title>
        </head>
        <body>
            <?php include 'header.php'; ?>
            <center> <span style="display:inline-block;width:100px;height:100px;background-image: url('css/image/gerecler/success.png');background-size: 100% 100%;margin-top:5%"> </span>
            <h4> Kayıt Başarıyla Yapıldı </h4> </center>
        </body>
        </html>
        <?php } 
    }
}
// Müsteri Kayıt islem Bitis

// Müsteri giris islem Baslangıc
if(isset($_POST["giris"]))
{

    session_start();
    $sifre = md5($_POST['sifre']);
    $mail = $_POST['mail'];
    $baglanti2 = new mysqli("localhost","root","","proje");
    $baglanti2->set_charset("utf8");
    $sorgum = $baglanti2->prepare("SELECT Adi,Soyadi,mail FROM musteriler WHERE mail=? AND Sifre=?");
    $sorgum->bind_param('ss',$mail,$sifre);
    $sorgum->execute();
    $sonuc = $sorgum->get_result();
    if($sonuc->num_rows ==1)
    {
        $row = $sonuc->fetch_assoc();
        if($row['mail']=="admin@outlook.com")
        {
            $_SESSION["admin"][1] = $row['Adi'].' '.$row['Soyadi'];
            $_SESSION["admin"][2] = $row['mail'];
        }
        else
        {
            $_SESSION['Kullanici'][1]=$row["Adi"]." ".$row["Soyadi"];
            $_SESSION['Kullanici'][2]=$row["mail"];

        }
        mysqli_close($baglanti);
        $baglanti2->close();
        $sorgum->close();
        if(isset($_POST['onay']))
        setcookie("KullaniciGiris",$row["mail"],time() + (60*60*72));
        header ("Location:index.php");
    }
    else
    {
        mysqli_close($baglanti);
        $baglanti2->close();
        $sorgum->close();
        header ("Location:index.php?mesaj");
    }





    /*$sifre=md5($_POST['sifre']);

    $sorgu = "SELECT Adi,Soyadi,mail  FROM musteriler WHERE  Mail='$_POST[mail]' AND Sifre= '$sifre'";
    $sonuc=mysqli_query($baglanti,$sorgu);
   if(1 == mysqli_num_rows($sonuc))
   {
       $row=mysqli_fetch_assoc($sonuc);
       if($row['mail']=="admin@outlook.com")
       {

        $_SESSION['admin'][1]=$row["Adi"]." ".$row["Soyadi"];
        $_SESSION['admin'][2]=$row["mail"];


       }
       else
       {
        $_SESSION['Kullanici'][1]=$row["Adi"]." ".$row["Soyadi"];
        $_SESSION['Kullanici'][2]=$row["mail"];

       //setcookie("Kullanici[1]",$row["Adi"]." ".$row["Soyadi"]);
       //setcookie("Kullanici[2]",$row["mail"]);
       }
       mysqli_close($baglanti);
       if(isset($_POST['onay']))
       setcookie("KullaniciGiris",$row["mail"],time() + (60*60*72));
       header ("Location:index.php");
       
   }
    else{
        mysqli_close($baglanti);
        header ("Location:index.php?mesaj");
    }  */
}
if(isset($_POST["cikis"]))

{
    session_start();
    if(isset($_SESSION["Kullanici"]))
    {
        unset($_SESSION["Kullanici"]);
    }
    else
        unset($_SESSION["admin"]);
    
    header ("Location:index.php");

}
// Müsteri giris islem Bitis

//begeni ve yorum işlemleri Baslangıc
if(isset($_POST["yorum_yaz"]))
{
    session_start();
    $resmin_uzantisi=$_POST["url"];
    $yorum=$_POST["yazilanYorum"];
    if(isset($_SESSION["Kullanici"]))
        $kullanici=$_SESSION["Kullanici"][1];
    else
        $kullanici=$_SESSION["admin"];
    $sorgum = "INSERT INTO yorumlar(uzanti,yorum,yorumYapan) VALUES ('$resmin_uzantisi','$yorum','$kullanici')";
    mysqli_query($baglanti,$sorgum);
    mysqli_close($baglanti);
    header ("Location:urun_sayfa.php?uzanti=".$resmin_uzantisi);
}

if(isset($_POST["cevap_yaz"]))
{
    session_start();
    $eleman=time();
    $resmin_uzantisi=$_POST["url"];
    $yorum=$_POST["yazilanYorum"];
    if(isset($_SESSION["Kullanici"]))
    $kullanici=$_SESSION["Kullanici"][1];
else
    $kullanici=$_SESSION["admin"];
    $anaYorumİndeks=$_POST["anaYorumİndeks"];
    $sorgum = "INSERT INTO yorumlar(uzanti,yorum,yorumYapan,altYorum) VALUES ('$resmin_uzantisi','$yorum','$kullanici','$anaYorumİndeks')";
    mysqli_query($baglanti,$sorgum);
    mysqli_close($baglanti);
    header ("Location:urun_sayfa.php?uzanti=".$resmin_uzantisi);


}

if(isset($_GET["yr"])) //ilk defa beğeni atacak olan
{
    session_start();
    $kullanici;
    $resmin_url=$_GET["url2"];
    $durum=$_GET["durum"];
    $yorumun_indisi=$_GET["url"];
    if(isset($_SESSION["Kullanici"]))
    $kullanici=$_SESSION["Kullanici"][2];
else
    $kullanici=$_SESSION["admin"][2];
    $ekle = "INSERT INTO begeni(numara,begenenKullanici,durum) VALUES ('$yorumun_indisi','$kullanici','$durum')";
    mysqli_query($baglanti,$ekle);
    mysqli_close($baglanti);
    header ('Location:urun_sayfa.php?uzanti='.$resmin_url);

}

if(isset($_GET["gn"]))//beğeni atıp değiştirmek isteyen
{
    session_start();
    $kullanici;
    $yorumun_indisi=$_GET["url"];
    $resmin_url=$_GET["url2"];
    $tercih=$_GET["durum"];
    if(isset($_SESSION["Kullanici"]))
    $kullanici=$_SESSION["Kullanici"][2];
else
    $kullanici=$_SESSION["admin"][2];
    $sorgum = "UPDATE begeni SET durum='$tercih' where begenenKullanici='$kullanici' and numara='$yorumun_indisi'";
    mysqli_query($baglanti,$sorgum);
    mysqli_close($baglanti);
    header ('Location:urun_sayfa.php?uzanti='.$resmin_url);

}
//begeni ve yorum işlemleri Bitiş

//sepet işlemi başlangıc

if(isset($_POST["sepet"]))
{
    $key=time();
    $adet=$_POST['adet'];
    $uzanti=$_GET['resim_url'];
    $deger= $_GET['resim_url'].'-'.$_POST["aromadegeri"].'-'.$_POST["adet"].'-'.$_GET["fiyat"].'-'.$_GET["aciklama"];
    setcookie('sepetim["'.$key.'"]',$deger,time()+60*30);
    $sorgu = "UPDATE proteinler SET satis=satis+'$adet' WHERE uzanti='$uzanti'";
    mysqli_query($baglanti,$sorgu);

    $stokdan_dusme = "UPDATE proteinler SET alimadeti=alimadeti-'$adet' WHERE uzanti='$uzanti'";
    $stokdan_dusme2 = "UPDATE aromalar SET stok=stok-'$adet' WHERE uzanti='$uzanti' and aroma='$_POST[aromadegeri]'";
    mysqli_query($baglanti , $stokdan_dusme);
    mysqli_query($baglanti , $stokdan_dusme2);

    $siparis_ekleme = "INSERT INTO siparisler(id,miktar,aroma,tarih,durum) values ('$uzanti',$adet,'$_POST[aromadegeri]',now()+INTERVAL 30 minute,'0')";
    if(mysqli_query($baglanti , $siparis_ekleme)) echo "calıştı";

    mysqli_close($baglanti);
    header ('Location:urun_sayfa.php?uzanti='.$_GET['resim_url']);

}
if(isset($_POST['Hemen_Al']))
{
    $key=time();
    $adet=$_POST['adet'];
    $uzanti=$_GET['resim_url'];
    $deger= $_GET['resim_url'].'-'.$_POST["aromadegeri"].'-'.$_POST["adet"].'-'.$_GET["fiyat"].'-'.$_GET["aciklama"];
    setcookie('sepetim["'.$key.'"]',$deger,time()+60*30);
    $sorgu = "UPDATE proteinler SET satis=satis+'$adet' WHERE uzanti='$uzanti'";
    mysqli_query($baglanti,$sorgu);

    $stokdan_dusme = "UPDATE proteinler SET alimadeti=alimadeti-'$adet' WHERE uzanti='$uzanti'";
    $stokdan_dusme2 = "UPDATE aromalar SET stok=stok-'$adet' WHERE uzanti='$uzanti' and aroma='$_POST[aromadegeri]'";
    mysqli_query($baglanti , $stokdan_dusme);
    mysqli_query($baglanti , $stokdan_dusme2);

    $siparis_ekleme = "INSERT INTO siparisler(id,miktar,aroma,tarih,durum) values ('$uzanti',$adet,'$_POST[aromadegeri]',now()+INTERVAL 30 minute),'0'";
    mysqli_query($baglanti , $siparis_ekleme);

    mysqli_close($baglanti);
    header ('Location:sepet.php'); 
}
if(isset($_GET["sepet_sil"]))
{
    $uzanti=explode('-',$_COOKIE['sepetim'][$_GET["sepet_sil"]])[0];
    $miktar=explode('-',$_COOKIE['sepetim'][$_GET["sepet_sil"]])[2];
    $aroma=explode('-',$_COOKIE['sepetim'][$_GET["sepet_sil"]])[1];

    setcookie('sepetim['.$_GET["sepet_sil"].']');
    $sorgu = "UPDATE proteinler SET satis=satis-'$miktar' WHERE uzanti='$uzanti'";
    $stok_ekleme = "UPDATE proteinler SET alimadeti=alimadeti+$miktar WHERE uzanti='$uzanti'";
    $stok_ekleme2 = "UPDATE aromalar SET stok=stok+$miktar WHERE uzanti='$uzanti' and aroma='$aroma'";
    
    mysqli_query($baglanti,$sorgu);
    mysqli_query($baglanti,$stok_ekleme);
    mysqli_query($baglanti,$stok_ekleme2);

    mysqli_close($baglanti);
    header ('Location:sepet.php');

    
}
//sepet işlemi bitiş

//admin işlemleri
if(isset($_POST["marka_adi_gonder"]))  //marka kayit
{
    for ($i=0; $i <$_GET["miktar"] ; $i++) { 
        $marka=ucfirst($_POST["marka_adi".$i]);
        $sorgu="INSERT INTO markalar(marka) VALUES ('$marka')";
        mysqli_query($baglanti,$sorgu);
    }
    mysqli_close($baglanti);
    
    header ('Location:index.php');
}

if(isset($_GET["aroma_miktar"])) //aroma kayit
{
    $resim_url=$_GET["url"];
    $sayfa_url = "urun_sayfa.php?uzanti=$resim_url";
    $miktar=$_GET["aroma_miktar"];
    echo $resim_url."<br>".$miktar;
    for ($i=0; $i <$miktar ; $i++) { 
        $aroma=$_POST['aroma'.$i];
        $stok=$_POST['stok'.$i];
        $kontrol_sorgu='SELECT * FROM aromalar WHERE uzanti="'.$resim_url.'" AND aroma="'.$aroma.'"';
        $result=mysqli_query($baglanti,$kontrol_sorgu);
        if(mysqli_num_rows($result)>0)
        {
            $sorgum='UPDATE aromalar SET stok=stok+"'.$stok.'" WHERE uzanti="'.$resim_url.'" AND aroma="'.$aroma.'" ';
            $sorgum2= "UPDATE proteinler SET alimadeti=alimadeti+$stok WHERE uzanti='$resim_url'";
            mysqli_query($baglanti,$sorgum);
            mysqli_query($baglanti,$sorgum2);

        }
        else
        {
            $sorgum="INSERT INTO aromalar(uzanti,aroma,stok) VALUES ('$resim_url','$aroma',$stok)";
            $sorgum2= "UPDATE proteinler SET alimadeti=alimadeti+$stok WHERE uzanti='$resim_url'";
            mysqli_query($baglanti,$sorgum);
            mysqli_query($baglanti,$sorgum2);
        }
    }
    mysqli_close($baglanti);
    header ('Location:'.$sayfa_url);
}

if(isset($_POST["sil"]))
{

    $resim_uzanti=$_GET["uzanti"];
    $sorgu='DELETE FROM proteinler where uzanti="'.$resim_uzanti.'"';
    $sorgu2='DELETE FROM aromalar where uzanti="'.$resim_uzanti.'"';
    $begeni_sil='DELETE FROM begeni where numara in (select numara from yorumlar where uzanti="'.$resim_uzanti.'")';
    $yorum_sil='DELETE FROM yorumlar where uzanti="'.$resim_uzanti.'"';

    mysqli_query($baglanti,$sorgu);
    mysqli_query($baglanti,$sorgu2);
    mysqli_query($baglanti,$begeni_sil);
    mysqli_query($baglanti,$yorum_sil);

    mysqli_close($baglanti);
   if($_GET["katagori"]!="a") header ('Location:protein.php?tur='.urlencode($_GET["tur"]).'&katagori='.urlencode($_GET["katagori"]));
    else header ('Location:protein.php?tur='.$_GET["tur"]);
    

}
if(isset($_POST["urun_ekle"])) //çok çeşitli ürün ekleme marka sabittir
{
    $uploaddir = 'image/proteinler'; // upload edilecek klasör
    $Resim_Tam_Adi;
    $marka=$_GET["marka"];

    $marka_kod_sorgu='SELECT marka_kod FROM markalar WHERE marka="'.$marka.'"';
    $row=mysqli_fetch_assoc(mysqli_query($baglanti,$marka_kod_sorgu));
    $marka_kod=$row["marka_kod"];

    $tur=$_GET["tur"];
    for ($i=0; $i <$_GET["miktar"]; $i++) { 
    
        
        $fiyat=$_POST["fiyat".$i].' TL';
        $aciklama=$_POST["aciklama".$i];
        $cesit=$_POST["cesit".$i];

        $img = getimagesize($_FILES['resim'.$i]['tmp_name']); // resmin boyutları ve türü için kullanılıyor manuale detayı için bakabilirsin 
        $ext = explode('/', $img['mime']); // resmin uzantısını alıyoruz jpg, png, gif...  
        //img içeriği Array ( [0] => 953 [1] => 960 [2] => 2 [3] => width="953" height="960" [bits] => 8 [channels] => 3 [mime] => image/jpeg )
        //$_FILES['resim']['tmp_name'] içeriği bir dosya yolu
        $new_name = time() . mt_rand(10000, 99999); // rastgele bir isim yaratıyoruz. yoksa aynı isimli dosya üstüne yazılabilir 
        $uploadfile = $new_name . '.' . $ext[1]; // yeni dosya ismi uzantısıyla birlikte ext[0] değeri image yazısı

        // resmi geçici klasöründen yüklemek istediğimiz yere taşıyoruz. 
        move_uploaded_file($_FILES['resim'.$i]['tmp_name'], $uploaddir . '/' . $uploadfile);
        $Resim_Tam_Adi = $uploaddir . '/' . $uploadfile;

        
        $sorgu="INSERT INTO proteinler(tur,fiyat,aciklama,uzanti,cesit,marka_kod) values('$tur','$fiyat','$aciklama','$Resim_Tam_Adi','$cesit',$marka_kod)";
        mysqli_query($baglanti,$sorgu);
        }
    mysqli_close($baglanti);
    header('Location:index.php');
}

if(isset($_POST["cesitsiz_urun_ekle"])) //örneğin kilo ve hacim alt katagori yokdur. marka sabittir
{
    $uploaddir = 'image/proteinler'; // upload edilecek klasör
    $Resim_Tam_Adi;
    $marka=$_GET["marka"];

    $marka_kod_sorgu='SELECT marka_kod FROM markalar WHERE marka="'.$marka.'"';
    $row=mysqli_fetch_assoc(mysqli_query($baglanti,$marka_kod_sorgu));
    $marka_kod=$row["marka_kod"];

    $tur=$_GET["tur"];

    for ($i=0; $i <$_GET["miktar"]; $i++)
    { 
    
        $fiyat=$_POST["fiyat".$i].' TL';
        $aciklama=$_POST["aciklama".$i];
        $resim='resim'.$i;

        $img = getimagesize($_FILES['resim'.$i]['tmp_name']); // resmin boyutları ve türü için kullanılıyor manuale detayı için bakabilirsin 
        $ext = explode('/', $img['mime']); // resmin uzantısını alıyoruz jpg, png, gif...  
        //img içeriği Array ( [0] => 953 [1] => 960 [2] => 2 [3] => width="953" height="960" [bits] => 8 [channels] => 3 [mime] => image/jpeg )
        //$_FILES['resim']['tmp_name'] içeriği bir dosya yolu
        $new_name = time() . mt_rand(10000, 99999); // rastgele bir isim yaratıyoruz. yoksa aynı isimli dosya üstüne yazılabilir 
        $uploadfile = $new_name . '.' . $ext[1]; // yeni dosya ismi uzantısıyla birlikte ext[0] değeri image yazısı

        // resmi geçici klasöründen yüklemek istediğimiz yere taşıyoruz. 
        move_uploaded_file($_FILES['resim'.$i]['tmp_name'], $uploaddir . '/' . $uploadfile);
        $Resim_Tam_Adi = $uploaddir.'/'. $uploadfile;


        $sorgu="INSERT INTO proteinler(tur,fiyat,aciklama,uzanti,marka_kod) values('$tur','$fiyat','$aciklama','$Resim_Tam_Adi',$marka_kod)";
        mysqli_query($baglanti,$sorgu);
    }
    mysqli_close($baglanti);
    header('Location:index.php');

}

if(isset($_POST["tekli_urun_gonder"])) // marka sabit değil
{

    $uploaddir = 'image/proteinler'; // upload edilecek klasör
    $Resim_Tam_Adi;
 
    $tur=$_GET["tur"];

    for ($i=0; $i <$_GET["miktar"]; $i++) { 
    
        
        $fiyat=$_POST["fiyat".$i].' TL';
        $aciklama=$_POST["aciklama".$i];
        $cesit=$_POST["cesit".$i];
        $resim='resim'.$i;
        $marka=$_POST["marka".$i];

        $img = getimagesize($_FILES['resim'.$i]['tmp_name']); // resmin boyutları ve türü için kullanılıyor manuale detayı için bakabilirsin 
        $ext = explode('/', $img['mime']); // resmin uzantısını alıyoruz jpg, png, gif...  
        //img içeriği Array ( [0] => 953 [1] => 960 [2] => 2 [3] => width="953" height="960" [bits] => 8 [channels] => 3 [mime] => image/jpeg )
        //$_FILES['resim']['tmp_name'] içeriği bir dosya yolu
        $new_name = time() . mt_rand(10000, 99999); // rastgele bir isim yaratıyoruz. yoksa aynı isimli dosya üstüne yazılabilir 
        $uploadfile = $new_name . '.' . $ext[1]; // yeni dosya ismi uzantısıyla birlikte ext[0] değeri image yazısı

        // resmi geçici klasöründen yüklemek istediğimiz yere taşıyoruz. 
        move_uploaded_file($_FILES['resim'.$i]['tmp_name'], $uploaddir . '/' . $uploadfile);
        $Resim_Tam_Adi = $uploaddir . '/' . $uploadfile;

        $marka_kod_sorgu='SELECT marka_kod FROM markalar WHERE marka="'.$marka.'"';
        $row=mysqli_fetch_assoc(mysqli_query($baglanti,$marka_kod_sorgu));
        $marka_kod=$row["marka_kod"];

        $sorgu="INSERT INTO proteinler(tur,fiyat,aciklama,uzanti,cesit,marka_kod) values('$tur','$fiyat','$aciklama','$Resim_Tam_Adi','$cesit',$marka_kod)";
        mysqli_query($baglanti,$sorgu);
        }
    mysqli_close($baglanti);
    header('Location:index.php');


}
if(isset($_POST["cesitsiz_tekli_urun_gonder"])) //marka sabit değil ve çeşit yokdur.
{
    $uploaddir = 'image/proteinler'; // upload edilecek klasör
    $Resim_Tam_Adi;

    $tur=$_GET["tur"];

    for ($i=0; $i <$_GET["miktar"]; $i++) { 
    
        $fiyat=$_POST["fiyat".$i];
        $aciklama=$_POST["aciklama".$i];
        $resim='resim'.$i;
        $marka=$_POST["marka".$i];

        $marka_kod_sorgu='SELECT marka_kod FROM markalar WHERE marka="'.$marka.'"';
        $row=mysqli_fetch_assoc(mysqli_query($baglanti,$marka_kod_sorgu));
        $marka_kod=$row["marka_kod"];

        $img = getimagesize($_FILES['resim'.$i]['tmp_name']); // resmin boyutları ve türü için kullanılıyor manuale detayı için bakabilirsin 
        $ext = explode('/', $img['mime']); // resmin uzantısını alıyoruz jpg, png, gif...  
        //img içeriği Array ( [0] => 953 [1] => 960 [2] => 2 [3] => width="953" height="960" [bits] => 8 [channels] => 3 [mime] => image/jpeg )
        //$_FILES['resim']['tmp_name'] içeriği bir dosya yolu
        $new_name = time() . mt_rand(10000, 99999); // rastgele bir isim yaratıyoruz. yoksa aynı isimli dosya üstüne yazılabilir 
        $uploadfile = $new_name . '.' . $ext[1]; // yeni dosya ismi uzantısıyla birlikte ext[0] değeri image yazısı

        // resmi geçici klasöründen yüklemek istediğimiz yere taşıyoruz. 
        move_uploaded_file($_FILES['resim'.$i]['tmp_name'], $uploaddir . '/' . $uploadfile);
        $Resim_Tam_Adi = $uploaddir.'/'. $uploadfile;


        $sorgu="INSERT INTO proteinler(tur,fiyat,aciklama,uzanti,marka_kod) values('$tur','$fiyat','$aciklama','$Resim_Tam_Adi',$marka_kod)";
        mysqli_query($baglanti,$sorgu);
        }
    mysqli_close($baglanti);
    header('Location:index.php');
}
//admin işlemleri bitiş


// Sayfalama class baslangıc
class sayfala
{
    private $result;
    public  $toplam_sayi = 0;
    private $tur;

    function __construct() {
        $argv = func_get_args(); 
        switch( func_num_args() ) {
            case 2:
                $this->__construct1($argv[0],$argv[1]);
                break;
            case 3:
               $this->__construct2( $argv[0], $argv[1] ,$argv[2] );
            
         }
    }
    
    function __construct1($getirme_basi , $tur) // katagorisiz işlemler için
    {
        $this->tur = $tur;
        $getir_sorgusu= "SELECT proteinler.fiyat , proteinler.aciklama , proteinler.uzanti , markalar.marka ,proteinler.alimadeti FROM proteinler
        inner join  markalar ON proteinler.marka_kod=markalar.marka_kod where tur='$tur' ORDER BY alimadeti DESC limit $getirme_basi, 15";
        $toplam_sayi_sorgu  = 'SELECT COUNT(uzanti) as sayi FROM proteinler where tur="'.$tur.'"';
        $toplam_sonuc = mysqli_query($GLOBALS['baglanti'] , $toplam_sayi_sorgu);
        $toplam_sayi = mysqli_fetch_assoc($toplam_sonuc);
        $this->toplam_sayi = $toplam_sayi["sayi"];
        $this->result = mysqli_query($GLOBALS['baglanti'] , $getir_sorgusu);
        mysqli_close($GLOBALS['baglanti']);
        
    }
    
    function __construct2($cesit , $getirme_basi , $tur) // katagorili  işlemler için
    {
 
        $getir_sorgusu= "SELECT proteinler.fiyat , proteinler.aciklama , proteinler.uzanti , proteinler.alimadeti, markalar.marka
        FROM proteinler inner join  markalar ON proteinler.marka_kod=markalar.marka_kod
        where cesit='$cesit' AND tur='$tur' ORDER BY alimadeti DESC  limit $getirme_basi, 15";
        $toplam_sayi_sorgu = 'SELECT COUNT(uzanti) as sayi FROM proteinler where cesit="'.$cesit.'"';
        $toplam_sonuc = mysqli_query($GLOBALS['baglanti'] , $toplam_sayi_sorgu);
        $toplam_sayi = mysqli_fetch_assoc($toplam_sonuc);
        $this->toplam_sayi = $toplam_sayi["sayi"];
        $this->result = mysqli_query($GLOBALS['baglanti'] , $getir_sorgusu);
        mysqli_close($GLOBALS['baglanti']);
    }

    function admin_div_bas($tur,$katagori) //silme işleminden geriye dönüşte tur ve katagori lazım
    {

        while($row = mysqli_fetch_assoc($this->result))
            {
            echo'    
                <div class="Urun_Satis_kutular">
                     <a href=urun_sayfa.php?uzanti='.$row['uzanti'].'> <img width=200 height=200 src='.$row['uzanti'].'> </a>
                    <a href= > '.$row['marka'].'</a>
                    <a href=urun_sayfa.php?uzanti='.$row['uzanti'].' style=font-size:0.8em>
                    '.$row['aciklama'].'
                    </a>
                    <div class=admin style=width:100%;height:9%;>
                        <form action=urun_sayfa.php?uzanti='.$row["uzanti"].' method=post>
                            <input type=text name=miktar placeholder=Aroma Miktari>
                            <input type=submit value=Aroma&nbsp;Ekle>
                        </form> 
                        <form form action=sinif.php?tur='.urlencode($tur).'&katagori='.urlencode($katagori).'&uzanti='.$row['uzanti'].' method=post>   
                            <input type=submit value=Sil name=sil>
                        </form>    
                    </div>

                </div>';
            } 
    }

    
    function div_bas()
    {
        while($row = mysqli_fetch_assoc($this->result))
            {
            echo'    
                <div class="Urun_Satis_kutular">';
                if($row['alimadeti']<=0) 
                echo'<div class="deneme" onclick=location.href=\'urun_sayfa.php?uzanti='.$row['uzanti'].'\'> <h5> Ürün Tükenmiştir </h5></div>';
                echo'
                    <a href=urun_sayfa.php?uzanti='.$row['uzanti'].'> <img width=200 height=200 src='.$row['uzanti'].'> </a>
                    <a href= > '.$row['marka'].'</a>
                    <a href=urun_sayfa.php?uzanti='.$row['uzanti'].' style=font-size:0.8em>
                    '.$row['aciklama'].'
                    </a>
                    <div style=width:100%;height:9%;>
                        <a href=urun_sayfa.php?uzanti='.$row['uzanti'].' >'.$row['fiyat'].' ';
                        if($row['alimadeti']>0)
                        echo'<div class="Sepete_ekle">
                            Sepete Ekle    
                        </div>';
                        
                       echo' </a>
                    </div> 

                </div>';
            } 
    }

    function kucuk_sayfala($sayfa)
    {
        if($sayfa>1) echo' <a href=protein.php?sayfa='.($sayfa-1).'&tur='.$this->tur.'> 
        <img src="image/sol.png"> &nbsp;&nbsp;
        </a>';
        for ($i=1; $i <=ceil($this->toplam_sayi/15) ; $i++)
        { 
            if($sayfa==$i) echo '<b style="color:#49af11">'.$i.'</b>&nbsp;';
            else echo'&nbsp; <a href=protein.php?sayfa='.($i).'&tur='.$this->tur.'>' .$i.' </a>';
        }

        if($sayfa<ceil($this->toplam_sayi/15)) echo' <a href=protein.php?sayfa='.($sayfa+1).'>  &nbsp;&nbsp;  <img src="image/sag.png"> </a>';
    }

    function buyuk_sayfala($sayfa)
    {
        if($sayfa>1) 
        echo' 
        <a href=protein.php?sayfa='.($sayfa-1).'&tur='.$this->tur.'><img src="image/sol.png"></a> &nbsp; &nbsp;';
        if($sayfa<3)
        {
            for($i=1; $i<=3;$i++)
            {
                
                if($sayfa==$i) echo '<a class=kutuluma><b style="color:#49af11">'.($i).'</b></a>&nbsp;';
                else echo'&nbsp; <a class=kutuluma href=protein.php?sayfa='.($i).'&tur='.$this->tur.'>' .($i).' </a>';
            }
            echo'&nbsp;... <a class=kutuluma href=protein.php?sayfa='.(ceil($this->toplam_sayi/15)).'&tur='.$this->tur.'>' .(ceil($this->toplam_sayi/15)).' </a>';
        }    
        else
            echo' <a class=kutuluma href=protein.php?sayfa='.(1).'&tur='.$this->tur.'> 1 </a>...&nbsp;';

        if($sayfa>=3 && $sayfa < ceil($this->toplam_sayi/15)-2 )
        {
            for($i = ($sayfa-1) ; $i <= ($sayfa+1) ; $i++)  
            {
               
                if($sayfa==$i) echo '<a class=kutuluma><b style="color:#49af11">'.($i).'</b></a>&nbsp;';
                else echo'&nbsp; <a class=kutuluma href=protein.php?sayfa='.($i).'&tur='.$this->tur.'>' .($i).' </a>';
            }
            echo'&nbsp;... <a class=kutuluma href=protein.php?sayfa='.(ceil($this->toplam_sayi/15)).'&tur='.$this->tur.'>' .(ceil($this->toplam_sayi/15)).' </a>';
        }
        if($sayfa >= ceil($this->toplam_sayi/15)-2)
        {
            for($i = ceil($this->toplam_sayi/15)-3 ; $i <= ceil($this->toplam_sayi/15) ; $i++)
            {
                if($sayfa==$i) echo '<a class=kutuluma><b style="color:#49af11">'.($i).'</b></a>&nbsp;';
                else echo'&nbsp; <a class=kutuluma href=protein.php?sayfa='.($i).'&tur='.$this->tur.'>' .($i).' </a>';
            }

        }
        if($sayfa<ceil($this->toplam_sayi/15))
            echo' <a href=protein.php?sayfa='.($sayfa+1).'&tur='.$this->tur.'>  &nbsp;   <img src="image/sag.png"> </a>';
    }

    function katagorili_kucuk_sayfala($sayfa , $katagori)
    {

        
        if($sayfa>1)
            echo' <a href=protein.php?sayfa='.($sayfa-1).'&katagori=' .urlencode($katagori).'&tur='.$this->tur.'>
                <img src="image/sol.png"> &nbsp;&nbsp;
            </a>';
        for ($i=1; $i <=ceil($this->toplam_sayi/15) ; $i++)
        { 
            if($sayfa==$i) echo '<b style="color:#49af11">'.$i.'</b>&nbsp;';
            else echo'&nbsp; <a href=protein.php?sayfa='.($i).'&katagori=' .urlencode($katagori). '&tur='.$this->tur.'>' .$i.' </a>';
        }

        if($sayfa<ceil($this->toplam_sayi/15)) 
            echo' <a href=protein.php?sayfa='.($sayfa+1).'&katagori=' .urlencode($katagori).'&tur='.$this->tur.'>
                &nbsp;&nbsp;   <img src="image/sag.png">
            </a>';
    }

    function katagorili_buyuk_sayfala($sayfa , $katagori)
    {

        if($sayfa>1) 
        echo' 
        <a href=protein.php?sayfa='.($sayfa-1).'&tur='.$this->tur.'&katagori= '.urlencode($katagori).';><img src="image/sol.png"></a> &nbsp; &nbsp;';
        if($sayfa<3)
        {
            for($i=1; $i<=3;$i++)
            {
                
                if($sayfa==$i) echo '<b style="color:#49af11">'.($i).'</b>&nbsp;';
                else echo'&nbsp; <a href=protein.php?sayfa='.($i).'&tur='.$this->tur.'&katagori= '.urlencode($katagori).'>' .($i).' </a>';
            }
            echo'&nbsp;... <a href=protein.php?sayfa='.(ceil($this->toplam_sayi/15)).'&tur='.$this->tur.'&katagori= '.urlencode($katagori).'>' .(ceil($this->toplam_sayi/15)).' </a>';
        }    
        else
            echo' <a href=protein.php?sayfa='.(1).'&tur='.$this->tur.'&katagori= '.urlencode($katagori).'> 1 </a>...&nbsp;';

        if($sayfa>=3 && $sayfa < ceil($this->toplam_sayi/15)-2 )
        {
            for($i = ($sayfa-1) ; $i <= ($sayfa+1) ; $i++)  
            {
               
                if($sayfa==$i) echo '<b style="color:#49af11">'.($i).'</b>&nbsp;';
                else echo'&nbsp; <a href=protein.php?sayfa='.($i).'&tur='.$this->tur.'&katagori= '.urlencode($katagori).'>' .($i).' </a>';
            }
            echo'&nbsp;... <a href=protein.php?sayfa='.(ceil($this->toplam_sayi/15)).'&tur='.$this->tur.'&katagori= '.urlencode($katagori).'>' .(ceil($this->toplam_sayi/15)).' </a>';
        }
        if($sayfa >= ceil($this->toplam_sayi/15)-2)
        {
            for($i = ceil($this->toplam_sayi/15)-3 ; $i <= ceil($this->toplam_sayi/15) ; $i++)
            {
                if($sayfa==$i) echo '<b style="color:#49af11">'.($i).'</b>&nbsp;';
                else echo'&nbsp; <a href=protein.php?sayfa='.($i).'&tur='.$this->tur.'&katagori= '.urlencode($katagori).'>' .($i).' </a>';
            }

        }
        if($sayfa<ceil($this->toplam_sayi/15))
            echo' <a href=protein.php?sayfa='.($sayfa+1).'&tur='.$this->tur.'&katagori= '.urlencode($katagori).'>  &nbsp;   <img src="image/sag.png"> </a>';
    }
} 
// Sayfalama class bitis

?>