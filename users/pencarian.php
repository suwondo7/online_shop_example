<?php
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$_SESSION['s_page'] = "home.php";
$keyword	= @$_POST['keyword'];
?>
<h2>Hasil Pencarian</h2>
<?php
$qData = "SELECT id_baju, foto, nama, keterangan, harga, id_baju_kategori FROM _baju WHERE (nama LIKE '%$keyword%') ORDER BY tanggal DESC LIMIT 0, 4";
$hqData = $db->sql($qData);
$rqData = $db->num_rows($hqData);
if($rqData == '0'){
	echo "Pencarian dengan kata kunci <b><i>\"$keyword\"</i></b> tidak ada";
}
while($rqData = $db->fetch_assoc($hqData)){
	$idBaju[] 			= $rqData['id_baju'];
	$fotoPath 			= explode("/", $rqData['foto']);
	$fotoBaju[]			= $fotoPath[1]."/".$fotoPath[2];
	$namaBaju[]			= $func->HighLight($rqData['nama'], $keyword);
	$keteranganBaju[]	= substr($rqData['keterangan'], 0, 40)."...";
	$hargaBaju[]		= number_format($rqData['harga'], 0, ',', '.');
	list($bajuKat) 		= $db->result_row("SELECT nama FROM _baju_kategori WHERE id_baju_kategori = '$rqData[id_baju_kategori]'");
	$kategoriBaju[]		= $bajuKat;
}
$db->close($hqData);
?>
<?php if(@$idBaju[0] != ""){ ?>
<div class="product_box margin_r40">
	<div class="image_wrapper">
		<a style="cursor:pointer;"><img src="<?php echo @$fotoBaju[0]; ?>" alt="<?php echo @$namaBaju[0]; ?>" width="240" height="120"/></a>
	</div>
	<h3><?php echo @$namaBaju[0]; ?></h3>
	<p><?php echo @$keteranganBaju[0]; ?></p>
	<p>Kategori : <b><i><?php echo @$kategoriBaju[0]; ?></i></b></p>
	<p class="price">Harga: Rp. <?php echo @$hargaBaju[0]; ?></p>
	<a style="cursor:pointer;" onclick="javascript: sendRequest('users/detail_baju.php', 'id=<?php echo @$idBaju[0]; ?>', 'content', 'div', '');">Detail</a> | <a style="cursor:pointer;" onclick="javascript: sendRequest('users/keranjang.php', 'id=<?php echo @$idBaju[0]; ?>', 'content', 'div', '');">Beli</a>
</div>
<?php } ?>
<?php if(@$idBaju[1] != ""){ ?>
<div class="product_box">	
	<div class="image_wrapper">
		<a style="cursor:pointer;"><img src="<?php echo @$fotoBaju[1]; ?>" alt="<?php echo @$namaBaju[1]; ?>" width="240" height="120"/></a>
	</div>
	<h3><?php echo @$namaBaju[1]; ?></h3>
	<p><?php echo @$keteranganBaju[1]; ?></p>
	<p>Kategori : <b><i><?php echo @$kategoriBaju[1]; ?></i></b></p>
	<p class="price">Harga: Rp. <?php echo @$hargaBaju[1]; ?></p>
	<a style="cursor:pointer;" onclick="javascript: sendRequest('users/detail_baju.php', 'id=<?php echo @$idBaju[1]; ?>', 'content', 'div', '');">Detail</a> | <a style="cursor:pointer;" onclick="javascript: sendRequest('users/keranjang.php', 'id=<?php echo @$idBaju[1]; ?>', 'content', 'div', '');">Beli</a>
</div>
<?php } ?>
<?php if(@$idBaju[2] != ""){ ?>
<div class="cleaner"></div>
<div class="product_box margin_r40">
	<div class="image_wrapper">
		<a style="cursor:pointer;"><img src="<?php echo @$fotoBaju[2]; ?>" alt="<?php echo @$namaBaju[2]; ?>" width="240" height="120"/></a>
	</div>
	<h3><?php echo @$namaBaju[2]; ?></h3>
	<p><?php echo @$keteranganBaju[2]; ?></p>
	<p>Kategori : <b><i><?php echo @$kategoriBaju[2]; ?></i></b></p>
	<p class="price">Harga: Rp. <?php echo @$hargaBaju[2]; ?></p>
	<a style="cursor:pointer;" onclick="javascript: sendRequest('users/detail_baju.php', 'id=<?php echo @$idBaju[2]; ?>', 'content', 'div', '');">Detail</a> | <a style="cursor:pointer;" onclick="javascript: sendRequest('users/keranjang.php', 'id=<?php echo @$idBaju[2]; ?>', 'content', 'div', '');">Beli</a>
</div>
<?php } ?>
<?php if(@$idBaju[3] != ""){ ?>
<div class="product_box">
	<div class="image_wrapper">
		<a style="cursor:pointer;"><img src="<?php echo @$fotoBaju[3]; ?>" alt="<?php echo @$namaBaju[3]; ?>" width="240" height="120"/></a>
	</div>
	<h3><?php echo @$namaBaju[3]; ?></h3>
	<p><?php echo @$keteranganBaju[3]; ?></p>
	<p>Kategori : <b><i><?php echo @$kategoriBaju[3]; ?></i></b></p>
	<p class="price">Harga: Rp. <?php echo @$hargaBaju[3]; ?></p>
	<a style="cursor:pointer;" onclick="javascript: sendRequest('users/detail_baju.php', 'id=<?php echo @$idBaju[3]; ?>', 'content', 'div', '');">Detail</a> | <a style="cursor:pointer;" onclick="javascript: sendRequest('users/keranjang.php', 'id=<?php echo @$idBaju[3]; ?>', 'content', 'div', '');">Beli</a>
</div>
<?php } ?>
<div class="cleaner"></div>