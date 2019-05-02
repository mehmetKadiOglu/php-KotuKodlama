    <?php
        include_once('header.php');
        $sorgum = 'SELECT proteinler.tur,proteinler.fiyat,proteinler.aciklama,proteinler.uzanti,proteinler.cesit,markalar.marka from
        proteinler inner join markalar on proteinler.marka_kod=markalar.marka_kod
        WHERE uzanti= "'.$_GET['uzanti'].'"';
        $sonuc = mysqli_query($baglanti , $sorgum);
        $elemanlar = mysqli_fetch_assoc($sonuc);

        function olumlu_isim($numara)
        {
            global $baglanti;
            $ana_yorum_olumlu_begenen_isim = "SELECT CONCAT(musteriler.Adi,' ',musteriler.Soyadi) AS ad FROM musteriler,begeni WHERE begeni.begenenKullanici=musteriler.mail AND begeni.numara='$numara' AND durum='1'";
            $ana_yorum_olumlu_begenen_isim_sonuc = mysqli_query($baglanti,$ana_yorum_olumlu_begenen_isim);
            while($olumlu_isimler=mysqli_fetch_assoc($ana_yorum_olumlu_begenen_isim_sonuc))
            {
                echo "$olumlu_isimler[ad]<br>";
            }
        }
        function olumsuz_isim($numara)
        {
            global $baglanti;
            $ana_yorum_olumsuz_begenen_isim = "SELECT CONCAT(musteriler.Adi,' ',musteriler.Soyadi) AS ad FROM musteriler,begeni WHERE begeni.begenenKullanici=musteriler.mail AND begeni.numara='$numara' AND durum='0'";
            $ana_yorum_olumsuz_begenen_isim_sonuc = mysqli_query($baglanti,$ana_yorum_olumsuz_begenen_isim);
            while($olumsuz_isimler=mysqli_fetch_assoc($ana_yorum_olumsuz_begenen_isim_sonuc))
            {
                echo "$olumsuz_isimler[ad]<br>";
            }
        }
        
        function alt_bas($id , $i)
        {
            global $baglanti;
            $eklenti= 'y'.$i;
            $ana_yorum_sorgusu = "SELECT uzanti,yorum,yorumTarihi,altYorum,yorumYapan FROM yorumlar where altYorum like '%$eklenti' and altYorum like '$id%'  ORDER BY yorumTarihi DESC";
            $sonuc2 = mysqli_query($baglanti , $ana_yorum_sorgusu);
            $eklenti='y'.($i+1);
            $width=80-$i;
            while($row2=mysqli_fetch_assoc($sonuc2))
            {
                $alt_yorum_begeni_olumsuz = 'SELECT COUNT(durum) as sayi FROM begeni WHERE numara="'.$row2["altYorum"].'" and durum=0';
                $alt_yorum_begeni_olumsuz_sonuc = mysqli_query($baglanti , $alt_yorum_begeni_olumsuz);
                $alt_olumsuz_begeni = mysqli_fetch_assoc($alt_yorum_begeni_olumsuz_sonuc);

                $alt_yorum_begeni_olumlu = 'SELECT COUNT(durum) as sayi  FROM begeni WHERE numara= "'.$row2["altYorum"].'" and durum=1';
                $alt_yorum_begeni_olumlu_sonuc = mysqli_query($baglanti , $alt_yorum_begeni_olumlu);
                $alt_olumlu_begeni = mysqli_fetch_assoc($alt_yorum_begeni_olumlu_sonuc);
                echo '
                    <section>
                    <div class="alt_yorum" style=margin-left:'.$i.'%;width:'.$width.'%>
                    <span>'.$row2["yorumTarihi"].' </span>
                    <span>'.$row2['yorumYapan'].'</span>
                    <p>'.$row2["yorum"].'</p>
                    </div>
                    <div class="begeni" style=margin-top:0px;>
                    Bu yorum yararlı oldu mu?';

                    if(isset($_SESSION["Kullanici"]) || isset($_SESSION['admin']))
                    {
                        $begenen;
                        if(isset($_SESSION['Kullanici'])) $begenen=$_SESSION["Kullanici"][2];
                        else $begenen=$_SESSION['admin'][2];
                        $alt_begeni_kontrol_sorgu='SELECT durum FROM begeni where numara= "'.$row2["altYorum"].'"
                        and begenenKullanici= "'.$begenen.'"';
                        $alt_begeni_kontrol = mysqli_query($baglanti,$alt_begeni_kontrol_sorgu);
                        $olumlu_link2 = 'onmouseover=gizleGoster("'.$row2["altYorum"].'") onmouseout=gizleGoster("'.$row2["altYorum"].'")';
                        $olumsuz_link2= 'onmouseover=gizleGoster("'.($row2["altYorum"].time()).'") onmouseout=gizleGoster("'.$row2["altYorum"].time().'")';
                        if(mysqli_num_rows($alt_begeni_kontrol)>0)
                        {
                            $sonuc = mysqli_fetch_assoc($alt_begeni_kontrol);
                            if($sonuc["durum"]=='0')
                            {
                                echo '
                                <a '.$olumlu_link2.' href=sinif.php?gn=ok&url='.$row2["altYorum"].'&url2='.$_GET['uzanti'].'&durum=1> Evet&nbsp;'.$alt_olumlu_begeni["sayi"].'</a>
                                <div style=display:none; onmouseover=gizleGoster("'.$row2["altYorum"].'")  onmouseout=gizleGoster("'.$row2["altYorum"].'")  class=olumlu_link id='.$row2["altYorum"].' >';
                                olumlu_isim($row2["altYorum"]);
                                echo '</div>

                                <a '.$olumsuz_link2.' >Hayır&nbsp;' .$alt_olumsuz_begeni["sayi"].'</a>
                                <div style=display:none; class=olumsuz_link  onmouseover=gizleGoster("'.$row2["altYorum"].time().'")  onmouseout=gizleGoster("'.$row2["altYorum"].time().'") id='.$row2["altYorum"].time().' >';
                                olumsuz_isim($row2["altYorum"]);
                                echo '</div>';
                            }
                            else{

                                echo '
                                <a '.$olumlu_link2.'> Evet&nbsp;'.$alt_olumlu_begeni["sayi"].'</a>
                                <div style=display:none; onmouseover=gizleGoster("'.$row2["altYorum"].'")  onmouseout=gizleGoster("'.$row2["altYorum"].'")  class=olumlu_link id='.$row2["altYorum"].' >';
                                olumlu_isim($row2["altYorum"]);
                                echo '</div>
                                
                                <a '.$olumsuz_link2.' href=sinif.php?gn=ok&url='.$row2["altYorum"].'&url2='.$_GET['uzanti'].'&durum=0>Hayır&nbsp;'.$alt_olumsuz_begeni["sayi"].'</a>
                                <div style=display:none; class=olumsuz_link  onmouseover=gizleGoster("'.$row2["altYorum"].time().'")  onmouseout=gizleGoster("'.$row2["altYorum"].time().'") id='.$row2["altYorum"].time().' >';
                                olumsuz_isim($row2["altYorum"]);
                                echo '</div>';
                            }
                        }
                        else{
                            echo '
                            <a '.$olumlu_link2.' href=sinif.php?yr=ok&url='.$row2["altYorum"].'&url2='.$_GET['uzanti'].'&durum=1> Evet&nbsp;'.$alt_olumlu_begeni["sayi"].'</a>
                            <div style=display:none; onmouseover=gizleGoster("'.$row2["altYorum"].'")  onmouseout=gizleGoster("'.$row2["altYorum"].'")  class=olumlu_link id='.$row2["altYorum"].' >';
                            olumlu_isim($row2["altYorum"]);
                            echo '</div>

                            <a '.$olumsuz_link2.' href=sinif.php?yr=ok&url='.$row2["altYorum"].'&url2='.$_GET['uzanti'].'&durum=0>Hayır&nbsp;'.$alt_olumsuz_begeni["sayi"].'</a>
                            <div style=display:none; class=olumsuz_link  onmouseover=gizleGoster("'.$row2["altYorum"].time().'")  onmouseout=gizleGoster("'.$row2["altYorum"].time().'") id='.$row2["altYorum"].time().' >';
                            olumsuz_isim($row2["altYorum"]);
                            echo '</div>';
                        }
                    }
                    else{

                        echo'
                     
                        <a> Evet&nbsp;'.$alt_olumlu_begeni["sayi"].'</a>
                        <a>Hayır&nbsp;'.$alt_olumsuz_begeni["sayi"].'</a>
                        
                        ';
                    }
                echo ' </div>'; //beğeni divi kapanış   

                
                if($i<=7 && ( isset($_SESSION['Kullanici']) || isset($_SESSION['admin'])))    
                {

                   echo' <button onclick=gizleGoster("sonuc'.$row2["altYorum"].'"); class=cevapla>Cevapla</button>
                    <div style="float:left;width:300px;">
                    <form id=sonuc'.$row2["altYorum"].' action="sinif.php" method="post" style="display:none">
                    <table>
                    <tr>
                    <td><textarea name="yazilanYorum" cols="90" rows="3"  style="resize:none;"></textarea></td>
                    <td><input type="submit" value="Gönder" name=cevap_yaz></td>
                    <td><input type="hidden" name=url value='.$_GET['uzanti'].'></td>
                    <td><input type="hidden" name=anaYorumİndeks value='.$row2['altYorum'].time().rand(0,300).$eklenti.'></td>
                    </tr>
                    </table>
                    </form>
                    </div>

                    </section>';
                }   
                alt_bas($row2["altYorum"] , $i+1);
                   
            }
        }
    ?>
    <script>
        var oncesecilenID;
        function aroma(ID) 
        {
            var secilenID = document.getElementById(ID);
            if(oncesecilenID==null)
            {
                oncesecilenID = document.getElementById(ID);
                oncesecilenID.style.background="#49af11";
                oncesecilenID.style.color="white";
                oncesecilenID.style.border="10";
                document.getElementById("aromadegeri").value=ID;
            }
            else
            {
                oncesecilenID.style.background="white";
                oncesecilenID.style.color="black";
                secilenID.style.background="#49af11";
                secilenID.style.color="white";
                oncesecilenID=secilenID;
                document.getElementById("aromadegeri").value=ID;
            }
        }

        function gizleGoster(ID) 
        {

                var secilenID = document.getElementById(ID);
                if (secilenID.style.display == "none") 
                {
                secilenID.style.display = "";
                } 

                else 
                {
                secilenID.style.display = "none";
                }
        }

    </script>

    <div class="genel"> 
        <div  class="ic_div_genel">

            <div class="ic_div1"  <?php echo 'style=background-image:url('.$elemanlar["uzanti"].')'?> ></div>     
            <div class="ic_div2">
                <a href=""> <?php echo $elemanlar["marka"]; ?></a>
                <h3><?php echo $elemanlar["aciklama"]; ?></h3>
                <table width="300px;">
                    <tr>
                        <td>Katagori   </td>
                        <td>:</td>
                        <td> <?php echo $elemanlar["cesit"]; ?> </td>
                    </tr>
                    <tr>
                        <td>Marka</td>
                        <td>:</td>
                        <td> <?php echo $elemanlar["marka"]; ?></td>
                    </tr>         
                    <tr>
                        <td>SKT(Son Kullanma Tarihi)</td>
                        <td>:</td>
                        <td></td>
                    </tr>                

                </table>
                <div class="aroma">
                <?php

                    $aroma_sorgu = "SELECT aroma FROM aromalar WHERE uzanti='$_GET[uzanti]' and stok>0";
                    $result = mysqli_query($baglanti , $aroma_sorgu);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo'<button class=aroma_button  id='.$row["aroma"].' onclick=aroma("'.$row["aroma"].'");>'.$row["aroma"].'</button>';
                    }

                ?>

                </div>

                <div class="fiyat">
                    <span>
                        <b>Ürün Fiyatı</b><br>
                        <a ><?php echo $elemanlar["fiyat"];?></a>
                    </span>
                    <span>
                        <b>Havale Fiyatı</b> <br>
                        <a>
                            <?php
                                $havale;
                                $dizi=explode(",",$elemanlar["fiyat"]);
                                $havale = $dizi[0];
                                $havale = $havale - ($havale * 0.05);
                                echo $havale;
                            ?>
                        </a>
                    </span>
                    <span>
                        <b>İndirim Oranı</b> <br>
                        <a>0</a>
                    </span>
                </div>

                <div class="aroma">
                   <?php echo' <form action=sinif.php?resim_url='.$_GET['uzanti'].'&aciklama='.urlencode($elemanlar["aciklama"]).'&fiyat='.$elemanlar["fiyat"].' method="post">';
                   
                    $protein_miktar = "SELECT alimadeti FROM proteinler where uzanti='$_GET[uzanti]'";
                    $sonuc_miktar = mysqli_query($baglanti,$protein_miktar);
                    $protein_miktar_sonuc = mysqli_fetch_assoc($sonuc_miktar);
                    if($protein_miktar_sonuc['alimadeti']>=6)
                    {
                        echo 
                            '<select name="adet" class="miktar">
                            <option value="">Seçiniz</option>';
                        for($i=0 ; $i<6 ; $i++)
                        {
                            echo "<option value=$i>$i</option>";
                        }
                        echo '</select>';
                    }
                    else
                    {
                        echo 
                            '<select name="adet" class="miktar">
                            <option value="">Seçiniz</option>';
                        for($i=0 ; $i<$protein_miktar_sonuc['alimadeti'] ; $i++)
                        {
                            echo "<option value=$i>$i</option>";
                        }
                        echo '</select>';
                    }

                    $type;
                    $protein_miktar_sonuc['alimadeti']>0 ? $type='submit' : $type='button';

                    echo'
                        <input type='.$type.' name="sepet" value="Sepete Ekle" class="Sepet_ekle">
                        <input type="hidden" name="aromadegeri" id="aromadegeri"  value="">
                        <input type='.$type.' value="Hemen Al" name="Hemen_Al" class="Sepet_ekle">';
                    ?>
                    </form>

                </div>
                <img src="image/banner_18.png" width="600px">

            </div>
        </div>
    </div>

    <?php 

        if(isset($_SESSION["admin"]) && isset($_POST["miktar"]) )
        {   
            $aroma="<option>Aromasız</option>
                    <option>Orman Meyveli</option>
                    <option>Kiraz</option>
                    <option>Karpuzlu </option>
                    <option>Elma</option>
                    <option>Kola</option>
                    <option>Ananas</option>";		
            if($elemanlar["tur"]=="Protein")
            {
                $aroma="<option> Çikolata </option>
                        <option> Çilek </option>
                        <option> Muz </option>
                        <option> Tarcın </option>
                        <option> Kurabiye </option>
                        <option> Karamel </option>";	
            }
            $miktar=$_POST["miktar"];
            echo '<form action=sinif.php?aroma_miktar='.$miktar.'&url='.$_GET["uzanti"].' method=post>
                    <table cellspacing="10">
                        <thead>
                            <tr>
                                <td><b>Aroma</b></td>
                                <td><b>Stok</b></td>
                            </tr>
                        </thead>';
                        for ($i=0; $i <$miktar ; $i++) { 
                        echo
                        '<tr>
                            <td><select name=aroma'.$i.'>'.$aroma.'</select></td>
                            <td><input type=text name=stok'.$i.'> </td>
                        </tr>';	
            }
                    echo
                        '<tr><td><input type=submit name= value=gönder></td></tr>
                    </table>
                </form>';	
        }
        else
        {
            ?>

            <div class="genel2"> 
                <div class="secenekler">
                    <a href="">ÜRÜN BİLGİSİ</a>
                    <a href="">TAKSİT SEÇENEKLERİ</a>
                    <a href="urun_sayfa.php?yorum">ÜRÜN YORUMLARI</a>
                    <a href="">ÖNERİLERİNİZ</a>
                </div>
                <div class="secenek_icerik">

                    <?php
                    $ana_yorum_sorgusu = "SELECT yorum,yorumTarihi,yorumYapan,numara FROM yorumlar
                    WHERE uzanti = '$_GET[uzanti]' and  altYorum='' ORDER BY yorumTarihi DESC";
                    $ana_yorum_sonuc = mysqli_query($baglanti , $ana_yorum_sorgusu);
                    if(mysqli_num_rows($ana_yorum_sonuc)>=1)
                    {
                        while($row=mysqli_fetch_assoc($ana_yorum_sonuc))
                        {
                            $ana_yorum_begeni_olumsuz = 'SELECT COUNT(durum) as sayi FROM begeni WHERE numara= "'.$row["numara"].'" and durum=0';
                            $ana_yorum_begeni_olumsuz_sonuc = mysqli_query($baglanti , $ana_yorum_begeni_olumsuz);
                            $olumsuz_begeni = mysqli_fetch_assoc($ana_yorum_begeni_olumsuz_sonuc);

                            $ana_yorum_begeni_olumlu = 'SELECT COUNT(durum) as sayi  FROM begeni WHERE numara= "'.$row["numara"].'" and durum=1';
                            $ana_yorum_begeni_olumlu_sonuc = mysqli_query($baglanti , $ana_yorum_begeni_olumlu);
                            $olumlu_begeni = mysqli_fetch_assoc($ana_yorum_begeni_olumlu_sonuc);

                            $ana_yorum_olumsuz_begenen_isim = "SELECT CONCAT(musteriler.Adi,' ',musteriler.Soyadi) AS ad FROM musteriler,begeni WHERE begeni.begenenKullanici=musteriler.mail AND begeni.numara='$row[numara]' AND durum='0'";
                            $ana_yorum_olumsuz_begenen_isim_sonuc = mysqli_query($baglanti,$ana_yorum_olumsuz_begenen_isim);
                            
                            echo '
                            <section>
                            <div class=ana_yorum>
                                <span>'.$row["yorumYapan"].'</span>
                                <span>'.$row["yorumTarihi"].' </span>
                                <p>'.$row["yorum"].'</p>
                            </div>

                            <div class="begeni">
                                Bu yorum yararlı oldu mu?
                                ';

                                if(isset($_SESSION["Kullanici"]) || isset($_SESSION["admin"]))
                                {
                                    $begenen_kisi="15";
                                    if(isset($_SESSION["Kullanici"])) $begenen_kisi=$_SESSION["Kullanici"][2];
                                    else   $begenen_kisi=$_SESSION["admin"][2];

                                    $begeni_kontrol_sorgu='SELECT durum FROM begeni where numara= "'.$row["numara"].'"
                                    and begenenKullanici= "'.$begenen_kisi.'"';
                                    $begeni_kontrol = mysqli_query($baglanti,$begeni_kontrol_sorgu);

                                    $olumlu_link ='onmouseover=gizleGoster("'.$row["numara"].'") onmouseout=gizleGoster("'.$row["numara"].'")';
                                    $olumsuz_link = 'onmouseover=gizleGoster("'.($row["numara"].time()).'") onmouseout=gizleGoster("'.$row["numara"].time().'")';
                                    if(mysqli_num_rows($begeni_kontrol)>=1)

                                    {
                                        $sonuc = mysqli_fetch_assoc($begeni_kontrol);
                                        if($sonuc["durum"]=='0')
                                        {
                                            echo '
                                            <a '.$olumlu_link.'  href=sinif.php?gn=ok&url='.$row["numara"].'&url2='.$_GET['uzanti'].'&durum=1> Evet&nbsp;'.$olumlu_begeni["sayi"].'</a>
                                            <div style=display:none; onmouseover=gizleGoster("'.$row["numara"].'")  onmouseout=gizleGoster("'.$row["numara"].'")  class=olumlu_link id='.$row["numara"].' >';
                                            olumlu_isim($row["numara"]);

                                            echo '</div>
                                            
                                            <a '.$olumsuz_link.' >Hayır&nbsp;' .$olumsuz_begeni["sayi"].'</a>
                                            <div style=display:none; class=olumsuz_link  onmouseover=gizleGoster("'.$row["numara"].time().'")  onmouseout=gizleGoster("'.$row["numara"].time().'") id='.$row["numara"].time().' >';
                                            olumsuz_isim($row["numara"]);
                                            echo '</div>';
                                        }
                                        else{

                                            echo '
                                            <a '.$olumlu_link.' > Evet&nbsp;'.$olumlu_begeni["sayi"].'</a>
                                            <div style=display:none; onmouseover=gizleGoster("'.$row["numara"].'")  onmouseout=gizleGoster("'.$row["numara"].'")  class=olumlu_link id='.$row["numara"].' >';
                                            olumlu_isim($row["numara"]);
                                            echo '</div>

                                            <a  '.$olumsuz_link.' href=sinif.php?gn=ok&url='.$row["numara"].'&url2='.$_GET['uzanti'].'&durum=0>Hayır&nbsp;'.$olumsuz_begeni["sayi"].'</a>
                                            <div style=display:none; class=olumsuz_link  onmouseover=gizleGoster("'.$row["numara"].time().'")  onmouseout=gizleGoster("'.$row["numara"].time().'") id='.$row["numara"].time().' >';
                                            olumsuz_isim($row["numara"]);
                                            echo '</div>';
                                        }
                                    }
                                    else{
                                        echo '
                                        <a '.$olumlu_link.' href=sinif.php?yr=ok&url='.$row["numara"].'&url2='.$_GET['uzanti'].'&durum=1> Evet&nbsp;'.$olumlu_begeni["sayi"].'</a>
                                        <div style=display:none; onmouseover=gizleGoster("'.$row["numara"].'")  onmouseout=gizleGoster("'.$row["numara"].'")  class=olumlu_link id='.$row["numara"].' >';
                                        olumlu_isim($row["numara"]);
                                        echo '</div>

                                        <a  '.$olumsuz_link.' href=sinif.php?yr=ok&url='.$row["numara"].'&url2='.$_GET['uzanti'].'&durum=0>Hayır&nbsp;'.$olumsuz_begeni["sayi"].'</a>
                                        <div style=display:none; class=olumsuz_link  onmouseover=gizleGoster("'.$row["numara"].time().'")  onmouseout=gizleGoster("'.$row["numara"].time().'") id='.$row["numara"].time().' >';
                                        olumsuz_isim($row["numara"]);
                                        echo '</div>';

                                    }

                                    echo'</div>
                                        <button onclick=gizleGoster("sonuc'.$row["numara"].'"); class=cevapla>Cevapla</button>
                                        <div style="float:left;width:300px;">
                                        <form id=sonuc'.$row["numara"].' action="sinif.php" method="post" style="display:none">
                                        <table>
                                        <tr>
                                        <td><textarea name="yazilanYorum" cols="90" rows="3"  style="resize:none;"></textarea></td>
                                        <td><input type="submit" value="Gönder" name=cevap_yaz></td>
                                        <td><input type="hidden" name=url value='.$_GET['uzanti'].'></td>
                                        <td><input type="hidden" name=anaYorumİndeks value='.$row['numara'].time().rand(0,300).'y1></td>
                                        </tr>
                                        </table>
                                        </form>
                                        </div></section>';
                                        

                                }
                                else{

                                    echo'   
                                        <a> Evet&nbsp;'.$olumlu_begeni["sayi"].'</a>
                                        <a> Hayır&nbsp;'.$olumsuz_begeni["sayi"].'</a>
                                        </div></section>';
                                        
                                    }
                                    alt_bas($row['numara'],1);
                        }//while
                    }
                    else
                    {
                        echo '<br><br><h3><center> Yorum Yapılmamıştır. Yorum Yapmak İçin Üye Olunuz</center></h3>';
                    }

                    ?>
                </div>
            </div> <!-- genel-2 div kapanış   -->
            <?php
        } 
    ?>   

    <!-- yorum divi başlangıc -->
    <?php
        if(isset($_SESSION["Kullanici"]))
        {

            echo'
            <form action="sinif.php" method="post" class="yorum_yaz">
                <table>
                    <tr>
                        <td><textarea name="yazilanYorum" cols="90" rows="5"  style="resize:none;"></textarea></td>
                        <td><input type="submit" value="Gönder" name=yorum_yaz></td>
                        <td><input type="hidden" name=url value='.$_GET['uzanti'].'></td>
                    </tr>
                </table>        
            </form>';
        }   
    ?>
    <!-- yorum divi bitiş-->
</body>
</html>