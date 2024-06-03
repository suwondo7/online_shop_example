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
	echo "<h2>Tujuan Pengiriman</h2>";
	echo "<div>";
		echo "<p>Barang akan dikirim ke alamat berikut, <b>harap di isi dengan alamat yang benar dan valid</b>.</p>";
		echo "<table>";
			echo "<tr>";
				echo "<td>Tujuan</td>";
				echo "<td>:</td>";
				echo "<td><input type='radio' name='rdtujuan' value='0' checked onclick=\"javascript: document.getElementById('hdtujuan').value='0';\" />&nbsp;Dalam Kota (Surabaya)
				&nbsp;<input type='radio' name='rdtujuan' value='1' onclick=\"javascript: document.getElementById('hdtujuan').value='1';\" />&nbsp;Luar Kota Surabaya&nbsp;
				<input type='hidden' name='hdtujuan' id='hdtujuan' value='0' /></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td valign='top'>Alamat</td>";
				echo "<td valign='top'>:</td>";
				echo "<td><textarea name='txtalamat' id='txtalamat'></textarea></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td colspan='3'><input type='button' value='Kirim' onclick=\"javascript: sendRequest('users/keranjang_proses.php','proc=finish&tujuan='+document.getElementById('hdtujuan').value+'&alamat='+document.getElementById('txtalamat').value,'content','div','');\" /></td>";
			echo "</tr>";
		echo "</table>";
	echo "</div>";
}
?>