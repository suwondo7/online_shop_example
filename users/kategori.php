<?php
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$limit = _limit_;

$_SESSION['s_page'] = "home.php";
$id = @$_POST['id'];
list($bajuKategori) = $db->result_row("SELECT nama FROM _baju_kategori WHERE id_baju_kategori = '$id'");
?>
<h2><?php echo $bajuKategori; ?></h2>
<?php
//Awal paging
if(@$_POST['start']=='') $start = 0;
else $start = @$_POST['start'];

//Tampilkan semua data
$qData = "SELECT id_baju, foto, nama, keterangan, harga, id_baju_kategori FROM _baju WHERE id_baju_kategori = '$id' ORDER BY tanggal DESC";
$hqData = $db->sql($qData);
$totalData = $db->num_rows($hqData);

if($totalData=='0'){
	echo "<p>Maaf, Produk belum ada</p>";
}else{
	//Batasi dengan limit
	$qData .= " LIMIT $start, $limit";
	$hqData = $db->sql($qData);
	while($rqData = $db->fetch_assoc($hqData)){
		$idBaju[] 			= $rqData['id_baju'];
		$fotoPath 			= explode("/", $rqData['foto']);
		$fotoBaju[]			= $fotoPath[1]."/".$fotoPath[2];
		$namaBaju[]			= $rqData['nama'];
		$keteranganBaju[]	= substr($rqData['keterangan'], 0, 40)."...";
		$hargaBaju[]		= number_format($rqData['harga'], 0, ',', '.');
		list($bajuKat) 		= $db->result_row("SELECT nama FROM _baju_kategori WHERE id_baju_kategori = '$rqData[id_baju_kategori]'");
		$kategoriBaju[]		= $bajuKat;
	}
	$db->close($hqData);
}
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
	<h3><?php echo $namaBaju[2]; ?></h3>
	<p><?php echo $keteranganBaju[2]; ?></p>
	<p>Kategori : <b><i><?php echo $kategoriBaju[2]; ?></i></b></p>
	<p class="price">Harga: Rp. <?php echo $hargaBaju[2]; ?></p>
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

<!-- Awal list paging -->
Halaman : 
<?php
$totalPage = ceil($totalData/$limit);
if($start != 0) echo "<a style='cursor:pointer;' onclick=\"javascript: sendRequest('users/kategori.php', 'start=".($start-$limit)."&id=$id', 'content', 'div', '');\">< Prev</a>";
$st = 0;
for($i=0; $i<$totalPage; $i++){
	$st = $i * $limit;
	if($st == $start) echo "&nbsp;<b>".($i+1)."</b>&nbsp;";
	else echo "&nbsp;<a onclick=\"javascript: sendRequest('users/kategori.php', 'start=$st&id=$id', 'content', 'div', '');\" style='cursor:pointer;'>".($i+1)."</a>&nbsp;";
}
if($start != $st) echo "<a style='cursor:pointer;' onclick=\"javascript: sendRequest('users/kategori.php', 'start=".($start+$limit)."&id=$id', 'content', 'div', '');\">Next ></a>";
?>
<!-- akhir list paging -->