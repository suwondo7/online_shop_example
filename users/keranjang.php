<?php
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$_SESSION['s_page'] = "users/keranjang.php";
if(!isset($_SESSION['s_emailCust'])){
	echo "<script language='javascript'>alert('Silahkan login dahulu sebagai member'); document.getElementById('txtuser').focus(); sendRequest('home.php', '', 'content', 'div', '');</script>";
}else{
	//Cek apakah ada pembelian yang masih pending
	$qCek = "SELECT id_pemesanan FROM _pemesanan WHERE email = '".@$_SESSION['s_emailCust']."' AND status = '0'";
	$hqCek = $db->sql($qCek);
	$rqCek = $db->num_rows($hqCek);
	if($rqCek == '0'){
		//Tambahkan barang ke keranjang belanja
		if(@$_POST['id'] != ''){
			//Cek jika barang sama hanya tambahkan jumlahnya saja
			if(isset($_SESSION['s_bajuChart'])){
				$nambah = true;
				$x=0;
				foreach($_SESSION['s_bajuChart'] as $idBaju){
					if(@$_POST['id'] == $idBaju){
						$nambah = false;
						$pos = $x;
					}
					$x++;
				}
				if($nambah == true){
					$_SESSION['s_bajuChart'][] = @$_POST['id'];
					$_SESSION['s_jumlahChart'][] = 1;
				}else{
					$_SESSION['s_jumlahChart'][$pos] = (@$_SESSION['s_jumlahChart'][$pos]) + 1;
				}
			}else{
				$_SESSION['s_bajuChart'][] = @$_POST['id'];
				$_SESSION['s_jumlahChart'][] = 1;
			}
		}
		
		echo "<h2>Keranjang Belanja</h2>";
		echo "<div>";
		if(isset($_SESSION['s_bajuChart']) && @count(@$_SESSION['s_bajuChart']) != 0){
			echo "<table class='table-list' width='95%'>";
				echo "<tr class='table-list-header'>";
					echo "<th>No.</th>";
					echo "<th>Nama Baju</th>";
					echo "<th>Harga</th>";
					echo "<th>Jumlah</th>";
					echo "<th>Subtotal</th>";
					echo "<th>&nbsp;</th>";
				echo "</tr>";
			$no=1; $x=0; $grandtotal = 0;
			foreach($_SESSION['s_bajuChart'] as $idBaju){
			//for($n=0; $n<@count(@$_SESSION['s_bajuChart']); $n++){
				list($namaBaju, $hargaBaju) = $db->fetch_row($db->sql("SELECT nama, harga FROM _baju WHERE id_baju = '$idBaju'"));
				echo "<tr class='table-list-row'>";
					echo "<td align='center'>$no.</td>";
					echo "<td>$namaBaju</td>";
					echo "<td align='right'>Rp. ".number_format($hargaBaju, 0, ',', '.')."</td>";
					echo "<td align='center'><input type='text' name='jumlah_$x' id='jumlah_$x' value='".$_SESSION['s_jumlahChart'][$x]."' size='3' style='text-align:center;' onkeyup=\"javascript: if(isNaN(this.value)){ alert('Harus Angka !'); this.value=''; }\" />&nbsp;<a style='cursor:pointer;' onclick=\"javascript: sendRequest('users/keranjang_proses.php','proc=refresh&pos=$x&id=$idBaju&jumlah='+document.getElementById('jumlah_$x').value,'content','div','');\"><img src='images/refresh.png' width='18' height='16' title='refresh' border='0' /></a></td>";
					$subtotal = $hargaBaju * (@$_SESSION['s_jumlahChart'][$x]);
					echo "<td align='right'>Rp. ".number_format($subtotal, 0, ',', '.')."</td>";
					echo "<td align='center'><a style='cursor:pointer;' onclick=\"javascript: sendRequest('users/keranjang_proses.php', 'proc=delete&pos=$x', 'content', 'div', '');\"><img src='images/remove.png' /></a></td>";
				echo "</tr>";
				$grandtotal += $subtotal;
				$no++;
				$x++;
			}
				echo "<tr class='table-list-row'>";				
					echo "<td align='center' colspan='4'><b>Grand Total</b></td>";
					echo "<td align='right'><b>Rp. ".number_format($grandtotal, 0, ',', '.')."</b></td>";
					echo "<td>&nbsp;</td>";
				echo "</tr>";
			echo "</table>";
			echo "<p>&nbsp;</p>";
			echo "<p>";
			echo "<input type='button' value='Belanja Lagi' onclick=\"javascript: sendRequest('home.php','','content','div','');\" />&nbsp;";
			echo "&nbsp;<input type='button' value='Selesai Belanja' onclick=\"javascript: if(confirm('Apakah yakin belanja sudah selesai?')) sendRequest('users/keranjang_tujuan.php','','content','div','');\"/>";
			echo "</p>";
		}else{
			echo "Anda belum memiliki keranjang belanja atau belum memilih baju satu pun";
		}
	}else{
		echo "<script>alert('Anda masih memiliki pemesanan yang belum dibayarkan');</script>";
		echo "<script>sendRequest('users/history.php','sign=ok','content','div','');</script>";
	}
	echo "</div>";
	echo "<div class='cleaner'></div>";
}
?>