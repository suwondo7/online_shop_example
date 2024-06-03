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
<!-- List pemesanan -->
<table class="table-list" width="98%">
	<tr class="table-list-header">
		<th>No.</th>
		<th>Tanggal</th>
		<th>Email</th>
		<th>Nama</th>
		<th>Status</th>
		<th colspan="2">&nbsp;</th>
	</tr>
	<?php
	if(@$_POST['start']=='') $start = 0; else $start = @$_POST['start'];
	
	$keyword = @$_POST['keyword'];
	$qSQL = "	
	SELECT A.id_pemesanan, A.tanggal, A.email, B.nama, A.status
	FROM _pemesanan AS A
		INNER JOIN _customer AS B ON (A.email = B.email)
	WHERE (B.nama LIKE '%$keyword%' OR A.email LIKE '%$keyword%') 
	ORDER BY A.email ASC
	";
	$hqSQL = $db->sql($qSQL);
	$totalData = $db->num_rows($hqSQL);
	$qSQL	.= " LIMIT $start, $limit";
	$hqSQL = $db->sql($qSQL);
	$totalLimit = $db->num_rows($hqSQL);
	
	if($totalData=='0'){
		echo "<tr><td colspan='7' align='center'>Data belum ada</td></tr>";
	}else{
		$no = 1;
		while($hasil = $db->fetch_assoc($hqSQL)){
			echo "<tr class='table-list-row'>";
			echo "<td align='center' width=3%>".$no.".</td>";
			echo "<td width=20% align='left'>".$func->SearchDay($hasil['tanggal']).", ".$func->ReportDate($hasil['tanggal'])."</td>";
			echo "<td width=30% align='left'>".$func->HighLight($hasil['email'], $keyword)."</td>";
			echo "<td width=30% align='left'>".$func->HighLight($hasil['nama'], $keyword)."</td>";
			
			switch($hasil['status']){
				case '0' :
					echo "<td align='center' width='3%'><a onclick=\"javascript: if(confirm('Apakah anda yakin?')) sendRequest('pemesanan_proses.php', 'proc=status&id=$hasil[id_pemesanan]', 'list', 'div', '../images/loader.gif'); \"><img src='../images/wait.png' border='0' title='Masih dalam proses pembayaran' /></a></td>";
					break;
				case '1' :
					echo "<td align='center' width='3%'><a onclick=\"javascript: if(confirm('Apakah anda yakin?')) sendRequest('pemesanan_proses.php', 'proc=status&id=$hasil[id_pemesanan]', 'list', 'div', '../images/loader.gif'); \"><img src='../images/approve.png' border='0' title='Barang sudah dikirim' /></a></td>";
					break;
			}
			
			echo "<td align='center' width='3%'><a onclick=\"javascript: bukaPopup('pemesanan_view.php?id=$hasil[id_pemesanan]', 2000); \"><img src='../images/view.gif' border='0' title='View Data' /></a></td>";			
			echo "<td align='center' width='3%'><a onclick=\"javascript: if(confirm('Yakin dihapus ta?')) sendRequest('pemesanan_proses.php', 'proc=delete&id=$hasil[id_pemesanan]', 'list', 'div', '../images/loader.gif');\"><img src='../images/delete.gif' border='0' title='Hapus Data' /></a></td>";
			echo "</tr>";
			
			$no++;
		}
	}
	?>
</table>
<table width="98%" class="paging">
	<tr>
		<td align="left">
			<?php echo "ditampilkan <b>".($totalLimit)."</b> sampai <b>".($start+$totalLimit)."</b> dari <b>$totalData</b> total data"; ?>
		</td>
		<td align="right">
			Halaman&nbsp;:&nbsp;
			<select name="f_paging" onchange="javascript: sendRequest('pemesanan_list.php','ajax=true&start='+parseInt(this.value)*<?php echo @$limit; ?>, 'list', 'div');">
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
<!-- End of list pemesanan -->