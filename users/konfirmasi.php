<?php
session_start();

include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$_SESSION['s_page'] = "users/keranjang.php";
?>
<form action="javascript: void(null);">
	<table>
		<tr>
			<td>Tanggal Transfer</td>
			<td>:</td>
			<td><input type="hidden" name="hdid" id="hdid" value="<?php echo @$_POST['id']; ?>" /><input type="text" name="txttanggal" id="txttanggal" size="10" value="<?php echo date("d/m/Y"); ?>" />&nbsp;<img src="includes/popup-calendar/calendar.gif" width="24" height="12" onclick="displayCalendar(document.getElementById('txttanggal'),'dd/mm/yyyy',this)" style="cursor:pointer"></td>
		</tr>
		<tr>
			<td>Bank Rekening Asal</td>
			<td>:</td>
			<td><input type="text" name="txtbank" id="txtbank" /></td>
		</tr>
		<tr>
			<td>Nama Pemilik Rekening Asal</td>
			<td>:</td>
			<td><input type="text" name="txtpemilik" id="txtpemilik" /></td>
		</tr>
		<tr>
			<td>Jumlah Dana Dikirim</td>
			<td>:</td>
			<td><input type="text" name="txtdana" id="txtdana" /></td>
		</tr>
		<tr>
			<td colspan="3"><input type="button" value="Kirim" onclick="javascript: sendRequest('users/keranjang_proses.php','proc=confirm&id='+document.getElementById('hdid').value+'&tanggal='+document.getElementById('txttanggal').value+'&bank='+document.getElementById('txtbank').value+'&pemilik='+document.getElementById('txtpemilik').value+'&dana='+document.getElementById('txtdana').value, 'content', 'div', '');" /></td>
		</tr>
	</table>
</form>