<?php // session_start(); ?>
<?php
if(isset($_SESSION['s_emailCust'])){
	if(@$_POST['ajax'] == 'true' || @$_GET['ajax'] == 'true'){
		include "../includes/config.php";
		include "../includes/functions.php";		
		$db = new Database();
		$func = new Functions();
	}
	?>
	<table>
		<tr>
			<td colspan="2"><img src="<?php echo @$_SESSION['s_fotoCust']; ?>" alt="<?php echo UcFirst($_SESSION['s_namaCust']); ?>" width="80" height="100" border="1" onclick="javascript: sendRequest('users/profil.php', '', 'content', 'div', '');" style="cursor:pointer;" /></td>
		</tr>
		<tr>
			<td><img src="images/users.gif" /></td>
			<td>&nbsp;Selamat <?php echo $func->Greetings(); ?>, <b><a style="cursor:pointer;" onclick="javascript: sendRequest('users/profil.php', '', 'content', 'div', '');"><?php echo UcFirst($_SESSION['s_namaCust']); ?></a></b></td>
		</tr>
		<tr>
			<td><img src="images/cart.png" width="22" height="22" /></td>
			<td>&nbsp;<a style="cursor:pointer;" onclick="javascript: sendRequest('users/keranjang.php', '', 'content', 'div', '');">Keranjang Belanja</a></td>
		</tr>
		<tr>
			<td><img src="images/history.png" width="22" height="22" /></td>
			<td>&nbsp;<a style="cursor:pointer;" onclick="javascript: sendRequest('users/history.php', '', 'content', 'div', '');">History Transaksi</a></td>
		</tr>
		<tr>
			<td><img src="images/logout.png" width="22" height="22" /></td>
			<td>&nbsp;<a style="cursor:pointer;" onclick="javascript: sendRequest('users/login_proses.php', 'proc=logout', 'content', 'div', '');">Keluar</a></td>
		</tr>
	</table>
<?php
}else{
	echo "<script>window.location.href='index.php';</script>";
}
?>