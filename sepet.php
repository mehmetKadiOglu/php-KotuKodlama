<?php 
    include_once('header.php');
    include('baglanti.php');

?>
<div class="ana">
    <section class="sepet_yazilar">
        <span class="genel_yazi">Resim</span>
        <span class="urunler_yazi">Ürünler</span>
        <span class="genel_yazi">Fiyat</span>
        <span class="adet_yazi">Adet</span>
        <span class="genel_yazi">Toplam</span>
        <span class="sil">Sil</span>
    </section>
    <?php
       if(isset($_COOKIE["sepetim"]))
        {
            foreach ($_COOKIE["sepetim"] as $key => $value) {
               $dizim = explode('-', $value); //dene bu kesin değil
               //$sorgum='SELECT aroma FROM aromalar WHERE uzanti="'.substr($key,1,strlen($key)-2).'"';
               $sorgum='SELECT aroma FROM aromalar WHERE uzanti="'.$dizim[0].'"';
               $sonuc=mysqli_query($baglanti,$sorgum);
               echo 
               '<section class="sepet_urunler">
               <span class=genel_yazi style=background-image:url('.$dizim[0].');></span>';  //resim
               echo 
                    '<span class="urunler_yazi">
                        '.$dizim[4]. '<br> <br>
                        Aroma&nbsp;&nbsp;
                        <select name="adet">';
                        while($row=mysqli_fetch_assoc($sonuc))
                        {
                            if($row["aroma"]==$dizim[1])
                            echo '<option selected>'.$row["aroma"].'</option>';
                            else 
                            echo '<option>'.$row["aroma"].'</option>';
                        }
                echo
                    '</select>
                    </span>
                    <span class="genel_yazi">'.$dizim[3].'&nbsp;TL</span>
                    <span class="adet_yazi">
                        <select name="adet" class="miktar">';

                            for ($i=1; $i <=6; $i++) { 
                                if($i==$dizim[2])   echo"<option selected>$i</option>";
                               else echo'<option>'.$i.'</option>';
                            }

                    echo'</select> 
                    </span>
                    <span class="genel_yazi">'.($dizim[2]*$dizim[3]).' TL</span>
                    <span class="sil"><a href=sinif.php?sepet_sil='.$key.'>Sil</a></span>
                    ';
            }
        }
    ?>
</div>
</body>
</html>