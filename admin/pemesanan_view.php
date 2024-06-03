<?php
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$biayaDalam = _biayaDalam_;
$biayaLuar	= _biayaLuar_;

$id = @$_GET['id'];
?>
<html>
	<head>
		<title>Pemesanan</title>
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
		<style type="text/css">
			.table-list{ color: inherit; font-family: verdana; font-size: xx-small; border: 0px outset; border-collapse: collapse;	}
			.table-list td{	padding: 1px; border: 1px solid; border-color: #ccc;  }
			.table-list-header{	background-color: #666; color: #fff; vertical-align: top; }
			.table-list-row{ background-color: #fff; }
			.table-list-row :hover{	background-color: #ccc;	}
		</style>
	</head>
<body bgcolor="white">
	<?php
	$qData = " SELECT tanggal, email, tujuan_pengiriman, alamat_pengiriman, tanggal_konfirmasi, bank_konfirmasi, nama_konfirmasi, jumlah_konfirmasi, status FROM _pemesanan WHERE id_pemesanan = '$id' ";
	$hqData = $db->sql($qData);
	list($tanggal, $email, $tujuanPengiriman, $alamatPengiriman, $tanggalKonfirmasi, $bankKonfirmasi, $namaKonfirmasi, $jumlahKonfirmasi, $status) = $db->fetch_row($hqData);
	?>
	<table width="100%">
		<tr>
			<td>
				<table>
					<tr>
						<td>Tanggal&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $func->SearchDay($tanggal).", ".$func->ReportDate($tanggal); ?></td>
					</tr>
					<tr>
						<td>Email&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $email; ?></td>
					</tr>
					<tr>
						<td>Tujuan&nbsp;Pengiriman</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($tujuanPengiriman == '0') echo "Dalam Kota Surabaya"; else echo "Luar Kota Surabaya"; ?></td>
					</tr>
					<tr>
						<td>Alamat&nbsp;Pengiriman</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $alamatPengiriman; ?></td>
					</tr>
					<tr>
						<td>Status&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($status == '0') echo "<span style='color:red;'>Menunggu pembayaran</span>"; if($status == '1') echo "<span style='color:green;'>Barang sudah dikirim</span>"; ?></td>
					</tr>
					<tr><td colspan="3"><hr style="border:1px solid grey;"></td></tr>
					<tr>
						<td>Tanggal&nbsp;Transfer</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($tanggalKonfirmasi == '0000-00-00 00:00:00') echo "-"; else echo $func->SearchDay($tanggalKonfirmasi).", ".$func->ReportDate($tanggalKonfirmasi); ?></td>
					</tr>
					<tr>
						<td>Bank&nbsp;Rekening&nbsp;Asal</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($bankKonfirmasi == '') echo "-"; else echo $bankKonfirmasi; ?></td>
					</tr>
					<tr>
						<td>Nama&nbsp;Pemilik&nbsp;Rekening&nbsp;Asal</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($namaKonfirmasi == '') echo "-"; else echo $namaKonfirmasi; ?></td>
					</tr>
					<tr>
						<td>Jumlah&nbsp;Dana&nbsp;Dikirim</td>
						<td>&nbsp;:&nbsp;</td>
						<td>Rp. <?php if($bankKonfirmasi == '0') echo "-"; else echo number_format($jumlahKonfirmasi, 0, ',', '.'); ?></td>
					</tr>
					<tr><td colspan="3"><hr style="border:1px solid grey;"></td></tr>
					<tr>
						<td colspan="3">
							<table class="table-list" width="100%">
								<tr class="table-list-header">
									<td>No.</td>
									<td>Baju</td>
									<td>Harga</td>
									<td>Jumlah</td>
									<td>Subtotal</td>
								</tr>
								<?php
								$qData = "SELECT B.nama, B.harga, A.jumlah, A.subtotal FROM _pemesanan_detail AS A INNER JOIN _baju AS B ON (A.id_baju = B.id_baju) WHERE A.id_pemesanan = '$id'";
								$hqData = $db->sql($qData);
								$grandTotal = 0;
								$no=1;
								while(list($namaBaju, $hargaBaju, $jumlah, $subtotal) = $db->fetch_row($hqData)){
									echo "<tr class='table-list-row'>";
										echo "<td align='center'>$no.</td>";
										echo "<td>$namaBaju</td>";
										echo "<td align='right'>Rp. ".number_format($hargaBaju, 0, ',', '.')."</td>";
										echo "<td align='center'>$jumlah</td>";
										echo "<td align='right'>Rp. ".number_format($subtotal, 0, ',', '.')."</td>";
									echo "</tr>";
									$grandTotal += $subtotal;
									$no++;
								}
								echo "<tr>";
								echo "<td colspan='4' align='center'><i>Jumlah Total</i></td>";
								echo "<td align='right'><i>Rp. ".number_format($grandTotal, 0, ',', '.')."</i></td>";
								echo "</tr>";
								$biayaKirim = 0;
								if($tujuanPengiriman == '0'){
									echo "<tr>";
									echo "<td colspan='4' align='center'><i>Biaya Pengiriman Dalam Kota</i></td>";
									echo "<td align='right'><i>Rp. ".number_format($biayaDalam, 0, ',', '.')."</i></td>";
									echo "</tr>";
									$biayaKirim = $biayaDalam;
								}else{
									echo "<tr>";
									echo "<td colspan='4' align='center'><i>Biaya Pengiriman Luar Kota (Via TIKI)</i></td>";
									echo "<td align='right'><i>Rp. ".number_format($biayaLuar, 0, ',', '.')."</i></td>";
									echo "</tr>";
									$biayaKirim = $biayaLuar;
								}
								$totalBiaya = $grandTotal + $biayaKirim;
								echo "<tr>";
								echo "<td colspan='4' align='center'><b>Jumlah Total</b></td>";
								echo "<td align='right'><b>Rp. ".number_format($totalBiaya, 0, ',', '.')."</b></td>";
								echo "</tr>";
								?>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?php if($status == '0'){ ?>
	<input type="button" class="button" value="Confirm" onclick="javascript: if(confirm('Apakah anda yakin?'))  window.parent.sendRequest('pemesanan_proses.php', 'proc=status&id=<?php echo $id; ?>', 'list', 'div', '../images/loader.gif'); window.top.tutupPopup(1000); " />
	<?php } ?>
	<input type="button" class="button" value="Tutup" onclick="javascript: window.top.tutupPopup(1000);" />
</body>
</html>