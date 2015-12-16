<?php
mysql_connect("localhost","root","");
mysql_select_db("autonumber");
//Fungsi autonumber
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
	$query="select $kolom from $tabel order by $kolom desc limit 1";
	$hasil=mysql_query($query);
	$jumlahrecord = mysql_num_rows($hasil);
	if($jumlahrecord == 0)
		$nomor=1;
	else
	{
		$row=mysql_fetch_array($hasil);
		$nomor=intval(substr($row[0],strlen($awalan)))+1;
	}
	if($lebar>0)
		$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
	else
		$angka = $awalan.$nomor;
	return $angka;
}
//Kode simpan
if(isset($_POST['simpan']))
{
	mysql_query("INSERT INTO produk values('$_POST[kode]','$_POST[produk]')");
}
?>
<form action="autonumber.php" method="post">
<label>Kode Produk</label><br>
<input type="text" style="background:#CCC; border:none" name="kode" value="<?=autonumber("produk","kd_produk",4,"PRD")?>" readonly="readonly"><br>
<label>Nama Produk</label><br>
<input type="text" name="produk"><br>
<input type="submit" value="Simpan" name="simpan" />
</form>
<table width="308" border="1" style="border-collapse:collapse; border:#000 1px solid;">
<tr>
	<td width="84" align="center">Kode Produk</td><td width="161" align="center">Nama Produk</td>
</tr>
<?php
	$q = mysql_query("SELECT * FROM produk order by kd_produk");
	while($data = mysql_fetch_array($q)){
		echo "<tr>
				<td>$data[kd_produk]</td><td>$data[produk]</td>
			  </tr>";	
	}
?>
</table>