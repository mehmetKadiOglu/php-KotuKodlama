

    <?php include 'header.php'; ?>
    <img class="orta_sayfa_resmi">
    
    <div id="orta_banner">
        <span style="background-image: url('image/banner_4.png');background-size: 100% 100%;"></span>
        <span style="background-image: url('image/banner_5.png');background-size: 100% 100%;"></span>
        <span style="background-image: url('image/banner_6.png');background-size: 100% 100%;"></span>  
    </div>
    
    <div style="margin-top:5%;margin-bottom:4%;" >
        <center>
            <h5 style="color:#0075ac;"> UYGUN FİYAT VE ÖZEL ÜRÜNLER</h5>
            <h2 style="color:#27354b;margin-top:-1%;">SİZİN İÇİN SEÇTİKLERİMİZ</h2>
        </center>
    </div>   

    <?php
    
    if(isset($_SESSION["admin"]))
        include('admin.php');


    ?>
    
    <div class="ana_div" >
    
    <?php
            $getir_sorgusu= 'SELECT proteinler.fiyat , proteinler.aciklama , proteinler.uzanti , markalar.marka
            FROM proteinler inner join  markalar ON proteinler.marka_kod=markalar.marka_kod WHERE alimadeti>0 ORDER BY RAND() LIMIT 5 ';
            $result = mysqli_query($baglanti,$getir_sorgusu);
    while($row = mysqli_fetch_assoc($result))
            {
            echo'    
                <div class="Urun_Satis_kutular"> 
                    <a href=urun_sayfa.php?uzanti='.$row['uzanti'].'> <img width=200 height=200 src='.$row['uzanti'].'> </a>
                    <a href= > '.$row['marka'].'</a>
                    <a href=urun_sayfa.php?uzanti='.$row['uzanti'].' style=font-size:0.8em>
                    '.$row['aciklama'].'
                    </a>
                    <div style=width:100%;height:9%;>
                        <a href=urun_sayfa.php?uzanti='.$row['uzanti'].' >'.$row['fiyat'].'
                        <div class="Sepete_ekle">
                            Sepete Ekle    
                        </div> </a>
                    </div>  
                </div>';
            }
    ?> 
    </div>
    
    <div style="clear:left;margin-bottom:4%">
        <center>
            <h5 style="color:#0075ac;" > SİZİN İÇİN DERLEDİK</h5>
            <h2 style="color:#27354b;margin-top:-1%;">EN ÇOK SATANLAR</h2>
        </center>
    </div> 
    
    <div class="ana_div">
    <?php
            $getir_sorgusu= 'SELECT proteinler.fiyat , proteinler.aciklama , proteinler.uzanti , markalar.marka
            FROM proteinler inner join  markalar ON proteinler.marka_kod=markalar.marka_kod ORDER BY satis DESC LIMIT 5 ';
            $result = mysqli_query($baglanti,$getir_sorgusu);
    while($row = mysqli_fetch_assoc($result))
            {
            echo'    
                <div class="Urun_Satis_kutular"> 
                    <a href=urun_sayfa.php?uzanti='.$row['uzanti'].'> <img width=200 height=200 src='.$row['uzanti'].'> </a>
                    <a href= > '.$row['marka'].'</a>
                    <a href=urun_sayfa.php?uzanti='.$row['uzanti'].' style=font-size:0.8em>
                    '.$row['aciklama'].'
                    </a>
                    <div style=width:100%;height:9%;>
                        <a href=urun_sayfa.php?uzanti='.$row['uzanti'].' >'.$row['fiyat'].'
                        <div class="Sepete_ekle">
                            Sepete Ekle    
                        </div> </a>
                    </div>  
                </div>';
            }
    ?>        
    </div>  
</body>
</html>
