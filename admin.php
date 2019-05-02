<?php include_once('baglanti.php');
$sorgum='SELECT marka from markalar order by marka asc';
$sonuc=mysqli_query($baglanti,$sorgum);

if(isset($_POST["marka_gonder"]))
{
	echo '<form action=sinif.php?miktar='.$_POST["miktar"].' method=post>';
	for($i=0 ; $i<$_POST["miktar"]; $i++)
		echo '<input type=text name=marka_adi'.$i.'><br>';
	echo '<input type=submit name=marka_adi_gonder></form>';
	
}
else if(isset($_POST["coklu_urun_gonder"]))
{	
	$cesit;
	$kontrol=0;		
	cesit_dondur();

	if($kontrol==1)
	{
		echo 
		'<div class=admin_secim>
			<form enctype="multipart/form-data" action=sinif.php?marka='.$_POST["markalar"].'&miktar='.$_POST["miktar"].'&tur='.urlencode($_POST["tur"]).' method=post>
				<table cellspacing="10">
					<thead>
						<tr>
							<td><b>Resimler</b></td>
							<td><b>Aciklama </b></td>
							<td><b>Ceşit </b></td>
							<td><b>Fiyat </b></td>
						</tr>
					</thead>';
					for($i=0 ; $i<$_POST["miktar"] ; $i++)
					{
						echo
							'
							<tr>
								<td>
									<input name="resim'.$i.'" type="file" />
								</td>

								<td>
									<textarea name="aciklama'.$i.'"  cols="30" rows="10" style="resize:none;"></textarea>
								</td>

								<td>
									<select name="cesit'.$i.'">'.$cesit.'</select>
								</td>

								<td>
									<input type="text" name="fiyat'.$i.'">
								</td>
							</tr>';
					}
					echo
					 '<tr>
						 <td>
							<input type=submit name=urun_ekle>
						</td>
					</tr>
				</table>
			</form>
		</div>';
		
	}
	
	else
	{
		echo 
		'<div class=admin_secim>
			<form enctype="multipart/form-data" action=sinif.php?marka='.$_POST["markalar"].'&tur='.urlencode($_POST["tur"]).'&miktar='.$_POST["miktar"].' method=post>
				<table cellspacing="10">
					<thead>
						<tr>
							<td><b>Resimler</b></td>
							<td><b>Aciklama </b></td>
							<td><b>Fiyat </b></td>
						</tr>
					</thead>';
					for($i=0 ; $i<$_POST["miktar"] ; $i++)
					{
						echo '
							<tr>
								<td><input name="resim'.$i.'" type="file" /></td>
								<td><textarea name="aciklama'.$i.'"  cols="30" rows="10" style="resize:none;"></textarea></td>
								<td><input type="text" name="fiyat'.$i.'" id=""></td>
							</tr>';
					}
					echo '
					<tr>
						<td>
							<input type=submit name=cesitsiz_urun_ekle>
						</td>
					</tr>
				</table>
			</form>
		</div>';
	}	
}
else if(isset($_POST["tekli_urun_gonder"]))
{
	$cesit;
	$kontrol=0;		
	cesit_dondur();

	if($kontrol==1)//çeşitli ürün ekleme alanı
	{
		$option="";
		$sorgum = 'SELECT marka FROM markalar ORDER BY marka ASC';
		$sonuc = mysqli_query($baglanti,$sorgum);
		while($row=mysqli_fetch_assoc($sonuc))
			$option=$option.'<option>'.$row["marka"].'</option>';

		echo '
			<form enctype="multipart/form-data" action=sinif.php?tur='.urlencode($_POST["tur"]).'&miktar='.$_POST["miktar"].' method=post>
				<table cellspacing="10">
					<thead>
						<tr>
							<td><b>Resimler</b></td>
							<td><b>Aciklama </b></td>
							<td><b>Ceşit </b></td>
							<td><b>Fiyat </b></td>
							<td><b>Marka </b></td>
						</tr>
					</thead>';
		for($i=0;$i<$_POST["miktar"];$i++)
		{
			echo
				'
				<tr>
					<td><input name="resim'.$i.'" type="file" /></td>
					<td><textarea name="aciklama'.$i.'"  cols="30" rows="10" style="resize:none;"></textarea></td>
					<td><select name="cesit'.$i.'">'.$cesit.'</select></td>
					<td><input type="text" name="fiyat'.$i.'" id=""></td>
					<td><select name=marka'.$i.'>'.$option.'</select></td>
				</tr>';
		}
		echo '<input type=submit name=tekli_urun_gonder></table> </form>';
	}
	
	else{
		$option="";
		$sorgum = 'SELECT marka FROM markalar ORDER BY marka ASC';
		$sonuc = mysqli_query($baglanti,$sorgum);
		while($row=mysqli_fetch_assoc($sonuc))
			$option=$option.'<option>'.$row["marka"].'</option>';

		echo '<form enctype="multipart/form-data" action=sinif.php?tur='.urlencode($_POST["tur"]).'&miktar='.$_POST["miktar"].' method=post>
				<table cellspacing="10">
					<thead>
						<tr>
							<td><b>Resimler</b></td>
							<td><b>Aciklama </b></td>
							<td><b>Fiyat </b></td>
							<td><b>Marka </b></td>
						</tr>
					</thead>';
		for($i=0 ; $i<$_POST["miktar"] ; $i++)
		{
			echo
				'
				<tr>
					<td><input name="resim'.$i.'" type="file" /></td>
					<td><textarea name="aciklama'.$i.'"  cols="30" rows="10" style="resize:none;"></textarea></td>
					<td><input type="text" name="fiyat'.$i.'" id=""></td>
					<td><select name=marka'.$i.'>'.$option.'</select></td>
				</tr>';
		}
		echo '<input type=submit name=cesitsiz_tekli_urun_gonder></table> </form>';
	}	

}


else{	
	
	$tur="	<option> Protein </option>
			<option> Amino Asit </option>
			<option> Kilo ve Hacim </option>
			<option> L-Karnitin ve CLA </option>
			<option> Kreatin </option>
			<option> Performans ve Güç </option>
			<option> Paketler </option>
			<option> Tatlandırıcılar </option>";

	echo'
	<div class=admin_secim>
		<section>
			<form action="" method="post">
				<table>
					<tr>
						<td width="120">Marka Ekle</td>
						<td width="120"><input type="text" name="miktar" ></td>
						<td width="120"><input type="submit" name="marka_gonder" ></td>
					</tr>
				</table>
				</table>
			</form>
		</section>

		<section>
			<form action="" method="post">
				<table>
					<tr>
						<td width="120">Çoklu Ürün Ekle</td>
						<td width="120"><input type="text" name="miktar" ></td>
						<td width="120">
							<select name="markalar">';
							while($row=mysqli_fetch_assoc($sonuc ))
								echo '<option>'.$row["marka"].'</option>';
							echo'</select>
						</td>
						<td width="120"><select name=tur>'.$tur.'</select></td>
						<td width="120"><input type="submit" name="coklu_urun_gonder" ></td>
					</tr>	
				</table>	
			</form>
		</section>

		<section>
			<form action="" method="post">
				<table>
					<tr>
						<td width="120">Tekli Ürün Ekle</td>
						<td width="120"><input type="text" name="miktar" ></td>
						<td width="120"><select name=tur>'.$tur.'</select></td>
						<td width="120"><input type="submit" name="tekli_urun_gonder" ></td>
					</tr>
				</table>	
			</form>
		</section>
	</div>';
}	
function cesit_dondur()
{
	global $cesit;
	global $kontrol; // bazı seceneklerde alt tür yok. Örneğin kilo ve hacim
	if($_POST["tur"]=="Protein")
	{
		$cesit="<option> Whey Protein </option>
				<option> İzole Protein </option>
				<option> Kompleks Protein  </option>
				<option> Protein Bar </option>
				<option> Kazein </option>
				<option> Et Proteini </option>
				<option> Protein Shake </option>
				<option> Soya Proteini </option>";
		$kontrol=1;
		
	}
	else if($_POST["tur"]=="Amino Asit")
	{
		$cesit="<option> BCAA </option>
				<option> Kompleks Amino Asit</option>
				<option> Glutamin  </option>
				<option>  Arjinin </option>
				<option>  Likit Amino Asit </option>
				<option>  AOL </option>";
		$kontrol=1;
	
	}			
	else if($_POST["tur"]=="L-Karnitin ve CLA")
	{
		$cesit="<option> Karnitin </option>
				<option> Termojenik</option>
				<option> CLA  </option>
				<option> Hazır İçeçek </option>
				<option>  Diğer Diyetik Ürünler </option>";	
		$kontrol=1;
				
	}
	else if($_POST["tur"]=="Kreatin")
	{
		$cesit="	<option> Kreatin Monohidrat </option>
				<option> Kompleks Kreatin</option>";
		$kontrol=1;
			
	}
				
	else if($_POST["tur"]=="Performans ve Güç")
	{
		
		$cesit="	<option> Güç ve Performans </option>
				<option> Enerji ve Dayanıklılık</option>
				<option> Karbonhidrat ve Jel  </option>
				<option> Tribulus </option>
				<option>  Kompleks Testosteron </option>";	
		$kontrol=1;
	}				
}


?>