<?php
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$biayaDalam = _biayaDalam_;
$biayaLuar = _biayaLuar_;

$_SESSION['s_page'] = "users/history.php";
if(isset($_SESSION['s_emailCust'])){	
	echo "<h2>Data Pemesanan</h2>";
	echo "<div>";
	$idPemesanan = @$_POST['id'];
	list($tanggal, $tujuanPengiriman, $alamatPengiriman, $status) = $db->result_row("SELECT tanggal, tujuan_pengiriman, alamat_pengiriman, status FROM _pemesanan WHERE id_pemesanan = '$idPemesanan'");
	echo "<table width='75%'>";
		echo "<tr>";
			echo "<td width='35%'>Kode Pemesanan</td>";
			echo "<td>:</td>";
			echo "<td><b>$idPemesanan</b></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Hari, Tanggal</td>";
			echo "<td>:</td>";
			echo "<td>".$func->SearchDay($tanggal).", ".$func->ReportDate($tanggal)."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Nama Customer</td>";
			echo "<td>:</td>";
			echo "<td>".@$_SESSION['s_namaCust']."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Tujuan</td>";
			echo "<td>:</td>";
			if($tujuanPengiriman == '0') echo "<td>Dalam kota Surabaya</td>";
			else echo "<td>Luar kota Surabaya</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Alamat Pengiriman</td>";
			echo "<td>:</td>";
			echo "<td>$alamatPengiriman</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Status</td>";
			echo "<td>:</td>";
			if($status == '0')	echo "<td><blink style='color:red;'>Menunggu pembayaran</blink></td>";
			else echo "<td><span style='color:green;'>Barang sudah dikirim</span></td>";
		echo "</tr>";
	echo "</table>";
	echo "<p>&nbsp;</p>";
	echo "<table class='table-list' width='100%'>";
		echo "<tr class='table-list-header'>";
			echo "<th>No.</th>";
			echo "<th>Nama Baju</th>";
			echo "<th>Harga</th>";
			echo "<th>Jumlah</th>";
			echo "<th>Subtotal</th>";
		echo "</tr>";
	$no=1; $x=0; $grandtotal = 0;
	$qData = "SELECT id_baju, jumlah, subtotal FROM _pemesanan_detail WHERE id_pemesanan = '$idPemesanan'";
	$hqData = $db->sql($qData);
	while(list($idBaju, $jumlahBaju, $subtotal) = $db->fetch_row($hqData)){
		list($namaBaju, $hargaBaju) = $db->result_row("SELECT nama, harga FROM _baju WHERE id_baju = '$idBaju'");
		echo "<tr class='table-list-row'>";
			echo "<td align='center'>$no.</td>";
			echo "<td>$namaBaju</td>";
			echo "<td align='right'>Rp. ".number_format($hargaBaju, 0, ',', '.')."</td>";
			echo "<td align='center'>$jumlahBaju</td>";
			$subtotal = $hargaBaju * $jumlahBaju;
			echo "<td align='right'>Rp. ".number_format($subtotal, 0, ',', '.')."</td>";
		echo "</tr>";
		$grandtotal += $subtotal;
		$no++;
		$x++;
	}
	$db->close($hqData);
	echo "<tr class='table-list-row'>";				
		echo "<td align='right' colspan='4'><i>Grand Total</i></td>";
		echo "<td align='right'><i>Rp. ".number_format($grandtotal, 0, ',', '.')."</i></td>";
	echo "</tr>";
	$biayaKirim = 0;
	if($tujuanPengiriman == '0'){
		echo "<tr class='table-list-row'>";				
			echo "<td align='right' colspan='4'><i>Biaya Pengiriman Dalam Kota Surabaya</i></td>";
			echo "<td align='right'><i>Rp. ".number_format($biayaDalam, 0, ',', '.')."</i></td>";
		echo "</tr>";
		$biayaKirim = $biayaDalam;
	}else{
		echo "<tr class='table-list-row'>";				
			echo "<td align='right' colspan='4'><i>Biaya Pengiriman Luar Kota Surabaya (Via TIKI)</i></td>";
			echo "<td align='right'><i>Rp. ".number_format($biayaLuar, 0, ',', '.')."</i></td>";
		echo "</tr>";
		$biayaKirim = $biayaLuar;
	}
	$totalBiaya = $grandtotal + $biayaKirim;
	echo "<tr class='table-list-row'>";				
		echo "<td align='right' colspan='4'><b>Total Biaya</b></td>";
		echo "<td align='right'><b>Rp. ".number_format($totalBiaya, 0, ',', '.')."</b></td>";
	echo "</tr>";
	echo "</table>";
	echo "<p>&nbsp;</p>";
	echo "<p>";
	echo "<input type='button' value='Export PDF' onclick=\"javascript: window.open('users/invoice-pdf.php?id=$idPemesanan', '_blank', 'menubar=no, width=600, height=400');\" />&nbsp;";
	echo "&nbsp;<input type='button' value='Print' onclick=\"javascript: window.print();\"/>&nbsp;";
	echo "&nbsp;<input type='button' value='Kembali' onclick=\"javascript: sendRequest('users/history.php','','content','div','');\"/>";
	echo "</p>";
	echo "</div>";
	if($status == '0'){
		echo "<div id='konfirmasi'>";
		echo "<ol>
				<li>Segera lakukan pembayaran ke rekening kami :
					<ul>
					<li><span style='font-weight: bold;'>BCA</span> 0331490252 an: Suwondo</li>
					<li><span style='font-weight: bold;'>Mandiri</span> 1440012113475 an: Suwondo</li>
					<li><span style='font-weight: bold;'>BNI</span> 0050365393 an: Suwondo</li>
					<li><span style='font-weight: bold;'>BRI</span> 320701018697533 an: Suwondo</li>
				</ul>
			</li>
			<li>Setelah melakukan pembayaran, segera lakukan konfirmasi <a style='cursor:pointer;color:blue;' onclick=\"javascript: sendRequest('users/konfirmasi.php', 'id=$idPemesanan', 'konfirmasi', 'div', '');\">di sini</a></li>
			<li>Barang akan dikirim paling lambat 3 hari setelah pembayaran. </li>
			<li>Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan kami hapus (transaksi batal).</li>
		</ol>";
		echo "</div>";
	}
	echo "<div class='cleaner'></div>";
}
?>