   
<?php
    include_once('sinif.php'); include 'header.php';
    $sql =  'SELECT cesit ,COUNT(*) as sayi FROM proteinler where tur="'.$_GET['tur'].'" GROUP BY cesit ORDER BY COUNT(*) DESC';
    $sql2 = 'SELECT COUNT(DISTINCT cesit) as sayi FROM proteinler where tur="'.$_GET['tur'].'"';
    $sql3 = "SELECT DISTINCT markalar.marka  FROM markalar INNER JOIN proteinler ON markalar.marka_kod=proteinler.marka_kod WHERE proteinler.tur='$_GET[tur]'";
    $sql4 = "SELECT COUNT( DISTINCT markalar.marka) as sayi FROM markalar INNER JOIN proteinler ON markalar.marka_kod=proteinler.marka_kod WHERE proteinler.tur='$_GET[tur]'";

    $sonuc = mysqli_query( $baglanti , $sql);
    $sonuc2 = mysqli_query( $baglanti , $sql2); //Cesitlerdeki div genişliği için kullanılcak
    $sonuc3 = mysqli_query( $baglanti , $sql3);
    $sonuc4 = mysqli_query( $baglanti , $sql4);
    $sayi  = mysqli_fetch_assoc($sonuc2);
    $marka_sayi = mysqli_fetch_assoc($sonuc4);

    $height = ($sayi["sayi"]/3)*31.5;
    $marka_height = ($marka_sayi["sayi"]/4)*31.5;
    if(mysqli_num_rows($sonuc)>1)
    {
    echo '<div class=Çeşitler style=height:'.$height.'px> <ul>';
   
    while($row=mysqli_fetch_assoc($sonuc))
    {
        echo '<li><a href=protein.php?katagori='.urlencode($row['cesit']).'&tur='.$_GET['tur'].'>'.$row['cesit'].'</a> <b> ('.$row['sayi'].')</b> </li>';
    }
    echo '</ul></div>';
    }

echo'
 <div class=Markalar style=height:'.$marka_height.'px ><ul>';
        while($row=mysqli_fetch_assoc($sonuc3))
        {
            echo "<li> $row[marka] </li>";
        }

echo'
            
        </ul>    
    </div> 

    <div class="ana_div">';
        
        
           
            $nesnem;
            $sayfa=1;
            $getirme_basi=0;
            if(isset($_GET["sayfa"]))
            {
                $sayfa=$_GET["sayfa"];
                
            } 
            $getirme_basi=($sayfa-1)*15;
        if(isset($_SESSION["admin"]))
        {
            $katagori="a";
            if(isset($_GET["katagori"])) //katagorili sınıflandırma örneğin izole whey
            {
                $katagori=$_GET["katagori"];
                $nesnem = new sayfala($katagori , $getirme_basi , $_GET['tur']);
                $nesnem->admin_div_bas($tur,$katagori);
                
               echo '<div class="sayfa_numara">';
                
                if(ceil($nesnem->toplam_sayi/15)<=4 && ceil($nesnem->toplam_sayi/15)>1)
                {
                    
                    $nesnem->katagorili_kucuk_sayfala($sayfa , $_GET["katagori"]);
                 }
               if(ceil($nesnem->toplam_sayi/15)>4)
                { 
                    
                    $nesnem->katagorili_buyuk_sayfala($sayfa , $_GET["katagori"]);
                }
                echo '</div>';
            }

            else
            {

                $nesnem = new sayfala($getirme_basi , $_GET['tur']); 
                $nesnem->admin_div_bas($_GET['tur'],$katagori);

                echo '<div class="sayfa_numara">';

                if(ceil($nesnem->toplam_sayi/15)<=4 && ceil($nesnem->toplam_sayi/15)>1)
                {
                   
                    $nesnem->kucuk_sayfala($sayfa);
                 }
               if(ceil($nesnem->toplam_sayi/15)>4)
                { 
                    
                    $nesnem->buyuk_sayfala($sayfa);
                    
                }

                echo '</div>';
            }

        }
        else
        {
            if(isset($_GET["katagori"])) //katagorili sınıflandırma örneğin izole whey
            {
                $nesnem = new sayfala($_GET["katagori"] , $getirme_basi , $_GET['tur']);
                $nesnem->div_bas();
                
               echo '<div class="sayfa_numara">';
                
                if(ceil($nesnem->toplam_sayi/15)<=4 && ceil($nesnem->toplam_sayi/15)>1)
                {
                   
                    $nesnem->katagorili_kucuk_sayfala($sayfa , $_GET["katagori"]);
                 }
               if(ceil($nesnem->toplam_sayi/15)>4)
                { 
                    $nesnem->katagorili_buyuk_sayfala($sayfa , $_GET["katagori"]);
                }
                echo '</div>';
            }

            else
            {
                $nesnem = new sayfala($getirme_basi , $_GET['tur']); 
                $nesnem->div_bas();

                echo '<div class="sayfa_numara">';

                if(ceil($nesnem->toplam_sayi/15)<=4 && ceil($nesnem->toplam_sayi/15)>1)
                {
                  
                    $nesnem->kucuk_sayfala($sayfa);
                 }
               if(ceil($nesnem->toplam_sayi/15)>4)
                { 
                    $nesnem->buyuk_sayfala($sayfa);
                }

                echo '</div>';
            }
        }               
        ?> 
    </div>

</body>
</html>