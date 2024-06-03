<?php
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$_SESSION['s_page'] = "home.php";

$id = @$_POST['id'];
$qData = "	SELECT 	A.id_baju, A.nama, B.nama, C.nama, A.warna, A.ukuran, 
					A.harga, A.foto, A.keterangan, A.stok, A.tanggal
			FROM _baju AS A
				INNER JOIN _baju_kategori AS B ON (A.id_baju_kategori = B.id_baju_kategori)
				INNER JOIN _baju_merk AS C ON (A.id_baju_merk = C.id_baju_merk)
			WHERE A.id_baju = '$id'
		";
$hqData = $db->sql($qData);
list($idBaju, $namaBaju, $namaKategori, $namaMerk, $warna, $ukuran, $harga, $foto, $keterangan, $stok, $tanggal) = $db->fetch_row($hqData); 
$fotoPath 	= explode("/", $foto);
$fotoBaju	= $fotoPath[1]."/".$fotoPath[2];

echo "<h2>$namaBaju</h2>";
?>
<div class="product_box margin_r40">
	<div class="image_wrapper">
		<a href="#"><img src="<?php echo @$fotoBaju; ?>" alt="<?php echo @$namaBaju; ?>" width="240" height="120"/></a>
	</div>
	<h3><?php echo @$namaBaju; ?></h3>
	<table width="95%" style="margin-left:-3px;">
		<tr>
			<td colspan="3"><?php echo @$keterangan; ?></td>
		</tr>
		<tr>
			<td>Merk</td>
			<td>:</td>
			<td><b><i><?php echo @$namaMerk; ?></i></b></td>
		</tr>
		<tr>
			<td>Kategori</td>
			<td>:</td>
			<td><b><i><?php echo @$namaKategori; ?></i></b></td>
		</tr>
		<tr>
			<td>Stok</td>
			<td>:</td>
			<td><b><i><?php echo @$stok; ?></i></b></td>
		</tr>
		<tr class="price">
			<td>Harga</td>
			<td>:</td>
			<td>Rp. <?php echo number_format(@$harga, 0, ',', '.'); ?></td>
		</tr>
	</table>
	<p><input type="button" value="Beli" onclick="javascript: sendRequest('users/keranjang.php', 'id=<?php echo @$idBaju; ?>', 'content', 'div', '');" />&nbsp;<input type="button" value="Kembali" onclick="javascript: sendRequest('home.php', '', 'content', 'div', '');" /></p>
</div>
<div class="cleaner"></div>