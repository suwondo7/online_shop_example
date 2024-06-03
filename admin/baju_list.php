<?php
if(@$_POST['ajax'] == 'true' || @$_GET['ajax'] == 'true'){
	session_start();
	include "../includes/config.php";
	include "../includes/functions.php";
	$db = new Database();
	$func = new Functions();
}else{
	global $db;
	global $func;
}
$limit = _limit_;
?>
<p>
	<span id="message" style="font-size:10px; color:#f00;text-decoration:blink;"><?php echo @$_SESSION['s_message']; unset($_SESSION['s_message']); ?></span>
</p>
<!-- List Baju -->
<table class="table-list" width="75%">
	<?php
	if(@$_POST['start']=='') $start = 0; else $start = @$_POST['start'];
	
	$keyword = @$_POST['keyword'];
	$qSQL = "	
	SELECT A.id_baju, A.nama AS baju, B.nama AS kategori, C.nama AS merk, A.stok
	FROM _baju AS A 
		INNER JOIN _baju_kategori AS B ON (A.id_baju_kategori = B.id_baju_kategori)
		INNER JOIN _baju_merk AS C ON (A.id_baju_merk = C.id_baju_merk)
	WHERE (A.nama LIKE '%$keyword%' OR B.nama LIKE '%$keyword%' OR C.nama LIKE '%$keyword%') 
	ORDER BY A.nama ASC
	";
	$hqSQL = $db->sql($qSQL);
	$totalData = $db->num_rows($hqSQL);
	$qSQL	.= " LIMIT $start, $limit";
	$hqSQL = $db->sql($qSQL);
	$totalLimit = $db->num_rows($hqSQL);
	?>
	<tr class="table-list-header">
		<th>&nbsp;</th>
		<th>Nama&nbsp;Baju&nbsp;</th>
		<th>Kategori&nbsp;</th>
		<th>Merk&nbsp;</th>
		<th>Stok&nbsp;</th>
		<th colspan="3">&nbsp;</th>
	</tr>
	<?php
	if($totalData=='0'){
		echo "<tr><td colspan='8' align='center'>Data belum ada</td></tr>";
	}else{
		$x = 0;
		while($hasil = $db->fetch_assoc($hqSQL)){
			echo "<tr class='table-list-row'>";
			echo "<td align='center' width=3%><input type='checkbox' name='cb$x' id='cb$x' value='$hasil[id_baju]' /></td>";
			echo "<td width=35% align='left'>".$func->HighLight($hasil['baju'], $keyword)."</td>";
			echo "<td width=20% align='left'>".$func->HighLight($hasil['kategori'], $keyword)."</td>";
			echo "<td width=15% align='left'>".$func->HighLight($hasil['merk'], $keyword)."</td>";
			echo "<td width=10% align='center'>".$func->HighLight($hasil['stok'], $keyword)."</td>";
			echo "<td align='center' width='3%'><a onclick=\"javascript: bukaPopup('baju_view.php?id=$hasil[id_baju]', 2000); \"><img src='../images/view.gif' border='0' title='View Data' /></a></td>";
			echo "<td align='center' width='3%'><a onclick=\"javascript: sendRequest('baju.php', 'id=$hasil[id_baju]&add=false', 'content', 'div', '../images/loader.gif'); \"><img src='../images/edit.gif' border='0' title='Edit Data' /></a></td>";
			echo "<td align='center' width='3%'><a onclick=\"javascript: if(confirm('Yakin dihapus ta?')) sendRequest('baju_proses.php', 'proc=delete&id=$hasil[id_baju]', 'list', 'div', '../images/loader.gif');\"><img src='../images/delete.gif' border='0' title='Hapus Data' /></a></td>";
			echo "</tr>";
			
			$x++;
		}
	}
	?>
</table>
<table>
	<tr>
		<td>
			<img src="../images/arrow.png" /><input type="checkbox" onclick="javascript: var jml=<?php echo @$totalData; ?>; if(this.checked==true){ for(i=0;i<jml;i++){document.getElementById('cb'+i).checked=true;}}else{for(i=0;i<jml;i++){document.getElementById('cb'+i).checked=false;}} " />&nbsp;
			<img src="../images/delete.gif" style="cursor:pointer;" onclick="javascript: var jml=<?php echo @$totalData; ?>; if(confirm('Hapus data yang terpilih ?')){ var id = new Array(jml); for(i=0;i<jml;i++){ if(document.getElementById('cb'+i).checked==true){ id[i] = document.getElementById('cb'+i).value; } } sendRequest('baju_proses.php', 'proc=delete_multiple&id='+id, 'list', 'div', '../images/loader.gif'); }" title="Hapus yang terpilih" />&nbsp;
			<img src="../images/export.png" style="cursor:pointer;" onclick="javascript: var jml=<?php echo $totalData; ?>; if(confirm('Export ke file?')){ var id = new Array(jml); for(i=0;i<jml;i++){ if(document.getElementById('cb'+i).checked==true){ id[i] = document.getElementById('cb'+i).value; } } sendRequest('baju_proses.php', 'proc=export_multiple&id='+id, 'list', 'div', '../images/loader.gif'); }" title="Export ke file"/>
		</td>
	</tr>
</table>
<table width="75%" class="paging">
	<tr>
		<td align="left">
			<?php echo "ditampilkan <b>".($totalLimit)."</b> sampai <b>".($start+$totalLimit)."</b> dari <b>$totalData</b> total data"; ?>
		</td>
		<td align="right">
			Halaman&nbsp;:&nbsp;
			<select name="f_paging" onchange="javascript: sendRequest('baju_list.php','ajax=true&start='+parseInt(this.value)*<?php echo @$limit; ?>, 'list', 'div', '../images/loader.gif');">
			<?php
			$jumlahPage = $totalData/$limit;
			for($a=0;$a<$jumlahPage;$a++){
				echo "<option value='$a'";
				if($start==$a*$limit) echo "selected";
				echo ">&nbsp;".($a+1)."&nbsp;</option>";
			}
			?>
			</select>
		</td>
	</tr>
</table>
<!-- End of list mata pelajaran -->