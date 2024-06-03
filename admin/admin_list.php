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
<!-- List Admin -->
<table class="table-list" width="50%">
	<tr class="table-list-header">
		<th>No.</th>
		<th>User</th>
		<th>Nama</th>
		<th colspan="2">&nbsp;</th>
	</tr>
	<?php
	if(@$_POST['start']=='') $start = 0; else $start = @$_POST['start'];
	
	$keyword = @$_POST['keyword'];
	$qSQL = "SELECT * FROM _admin WHERE (usernames LIKE '%$keyword%' OR nama LIKE '%$keyword%') ORDER BY usernames ASC";
	$hqSQL = $db->sql($qSQL);
	$totalData = $db->num_rows($hqSQL);
	$qSQL	.= " LIMIT $start, $limit";
	$hqSQL = $db->sql($qSQL);
	$totalLimit = $db->num_rows($hqSQL);
	
	if($totalData=='0'){
		echo "<tr><td colspan='5' align='center'>Data belum ada</td></tr>";
	}else{
		$no = 1;
		while($hasil = $db->fetch_assoc($hqSQL)){
			echo "<tr class='table-list-row'>";
			echo "<td align=\"center\" width=5%>".$no.".</td>";
			echo "<td width=35%>".$func->HighLight($hasil['usernames'], $keyword)."</td>";
			echo "<td>".$func->HighLight($hasil['nama'], $keyword)."</td>";
			echo "<td align='center' width='5%'><a onclick=\"javascript: sendRequest('admin.php', 'id=$hasil[usernames]&add=false', 'content', 'div', '../images/loader.gif'); \"><img src='../images/edit.gif' border='0' title='Edit Data' /></a></td>";
			echo "<td align='center' width='5%'><a onclick=\"javascript: if(confirm('Yakin dihapus?')) sendRequest('admin_proses.php', 'proc=delete&user=$hasil[usernames]', 'list', 'div', '../images/loader.gif');\"><img src='../images/delete.gif' border='0' title='Hapus Data' /></a></td>";
			echo "</tr>";
			
			$no++;
		}
	}
	?>
</table>
<table width="50%" class="paging">
	<tr>
		<td align="left">
			<?php echo "ditampilkan <b>".($totalLimit)."</b> sampai <b>".($start+$totalLimit)."</b> dari <b>$totalData</b> total data"; ?>
		</td>
		<td align="right">
			Halaman&nbsp;:&nbsp;
			<select name="f_paging" onchange="javascript: sendRequest('admin_list.php','ajax=true&start='+parseInt(this.value)*<?php echo $limit; ?>, 'list', 'div', '../images/loader.gif');">
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
<!-- End of list admin -->