<?php
global $db;
?>
<ul class="categories_list">
<?php
$qData = "SELECT id_baju_kategori, nama FROM _baju_kategori ORDER BY nama ASC";
$hqData = $db->sql($qData);
while(list($idBajuKategori, $namaKategori) = $db->fetch_row($hqData)){
	echo "<li><a style='cursor:pointer;' onclick=\"javascript: sendRequest('users/kategori.php', 'id=$idBajuKategori', 'content', 'div', '');\">$namaKategori</a></li>";
}
$db->close($hqData);
?>
</ul>