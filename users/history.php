<?php
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$_SESSION['s_page'] = "users/history.php";
$email = @$_SESSION['s_emailCust'];
?>
<h2>History Transaksi</h2>
<div>
	<table class="table-list" width="100%">
		<tr class="table-list-header">
			<th>No.</th>
			<th>Kode Pemesanan</th>
			<th>Hari, Tanggal</th>
			<th colspan="2">Status</th>
		</tr>
		<?php
		$qData = "SELECT id_pemesanan, tanggal, status FROM _pemesanan WHERE email = '$email'";
		$hqData = $db->sql($qData);
		$rqData = $db->num_rows($hqData);
		if($rqData == '0'){
			echo "<tr><td colspan='5' align='center'>Belum ada data transaksi</td></tr>";
		}else{
			$no=1;
			while(list($idPemesanan, $tanggal, $status) = $db->fetch_row($hqData)){
				if(@$_POST['sign'] == 'ok' && $status == '0'){
					echo "<tr style='background-color:red; text-decoration:blink;' onclick=\"javascript: sendRequest('users/konfirmasi.php','id=$idPemesanan','content','div','');\">";
				}else{
					echo "<tr class='table-list-row'>";
				}
					echo "<td align='center'>$no.</td>";
					echo "<td align='center'>$idPemesanan</td>";
					echo "<td align='center'>".$func->SearchDay($tanggal).", ".$func->ReportDate($tanggal)."</td>";
					if($status == '0') $st = "<a style='cursor:pointer;' onclick=\"javascript: sendRequest('users/konfirmasi.php','id=$idPemesanan','content','div','');\"><img src='images/wait.png' title='Proses pelunasan pembayaran' border='0' /></a>";
					if($status == '1') $st = "<img src='images/approve.png' title='Barang sudah dikirim' border='0' />";
					echo "<td align='center'>$st</td>";
					echo "<td align='center'><a style='cursor:pointer;' onclick=\"javascript: sendRequest('users/history_detail.php','id=$idPemesanan','content','div','');\"><img src='images/view.png' title='Detail pemesanan' border='0' /></a></td>";
				echo "</tr>";
				
				$no++;
			}
			
		}
		$db->close($hqData);
		?>
	</table>
	<p style="margin-top:10px; font-size:12px;">Jumlah total transaksi pemesanan : <b><?php echo $rqData; ?></b></p>
	<p style="margin-bottom:0px;"><b>Keterangan :</b></p>
	<table>
		<tr>
			<td><img src="images/wait.png" title="Proses pelunasan pembayaran" border="0" /></td>
			<td>:</td>
			<td>Proses Pelunasan Pembayaran</td>
		</tr>
		<tr>
			<td><img src="images/approve.png" title="Barang sudah dikirim" border="0" /></td>
			<td>:</td>
			<td>Barang Sudah Dikirim</td>
		</tr>
	</table>
</div>