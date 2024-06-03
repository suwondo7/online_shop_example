<?php
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$id = @$_GET['id'];
?>
<html>
	<head>
		<title>Baju</title>
		<script type="text/javascript" src="../includes/jquery-1.4.2.min.js"></script>
		<script language="javascript">
			$(document).ready(function(){
				$(document).focus();
			});
			$(document).keyup(function(event){
				if (event.keyCode == 27) {
					window.top.tutupPopup(1000);
				}
			});
		</script>
		<link rel="stylesheet" href="../includes/popup-window/popup.css"></link>
	</head>
<body bgcolor="white">
	<?php
	$qData = " 	
	SELECT A.id_baju, A.nama, B.nama, C.nama, A.warna, A.ukuran, A.harga, A.foto, A.keterangan, A.stok 				
	FROM _baju AS A
		INNER JOIN _baju_kategori AS B ON (A.id_baju_kategori = B.id_baju_kategori)
		INNER JOIN _baju_merk AS C ON (A.id_baju_merk = C.id_baju_merk)
	WHERE id_baju = '$id' 
	";
	$hqData = $db->sql($qData);
	list($idBaju, $namaBaju, $namaKategori, $namaMerk, $warna, $ukuran, $harga, $foto, $keterangan, $stok) = $db->fetch_row($hqData);
	?>
	<table width="100%">
		<tr>
			<td>
				<table>
					<tr>
						<td>Nama&nbsp;Baju&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $namaBaju; ?></td>
					</tr>
					<tr>
						<td>Kategori&nbsp;Baju&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $namaKategori; ?></td>
					</tr>
					<tr>
						<td>Merk&nbsp;Baju&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $namaMerk; ?></td>
					</tr>
					<tr>
						<td>Warna&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $warna; ?></td>
					</tr>
					<tr>
						<td>Ukuran&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $ukuran; ?></td>
					</tr>
					<tr>
						<td>Harga&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $harga; ?></td>
					</tr>
					<tr>
						<td>Keterangan&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $keterangan; ?></td>
					</tr>
					<tr>
						<td>Stok&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $stok; ?></td>
					</tr>
					<tr>
						<td valign="top">Foto&nbsp;</td>
						<td valign="top">&nbsp;:&nbsp;</td>
						<td><img src="<?php if(file_exists($foto)) echo $foto; else echo "../images/fotokosong.gif"; ?>" width="80" height="100" border="1" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<input type="button" class="button" value="Tutup" onclick="javascript: window.top.tutupPopup(1000);" />
</body>
</html>