<?php session_start(); ?>
<?php 	
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

if(isset($_SESSION['s_userAdmin'])){
	$_SESSION['s_adminPage'] = "pemesanan.php";
	
	?>
	<h2>DATA PEMESANAN</h2>
	<form name="f_cari" action="javascript: void(null);">
		<table>
			<tr>
				<td>Pencarian</td>
				<td>:</td>
				<td><input type="text" name="x_keyword" value="<?php echo @$_POST['keyword']; ?>" autocomplete="off" onkeyup="javascript: /*if(event.keyCode=='13')*/ sendRequest('pemesanan_list.php', 'ajax=true&keyword='+this.value, 'list', 'div', '../images/loader.gif');" /></td>
				<td>
					<input type="button" class="button" value="Cari" onClick="javascript: sendRequest('pemesanan_list.php', 'ajax=true&keyword='+document.f_cari.x_keyword.value, 'list', 'div', '../images/loader.gif');" />
					<a style="cursor:pointer;" onclick="javascript: sendRequest('pemesanan_list.php', 'ajax=true&', 'list', 'div', '../images/loader.gif'); document.f_cari.x_keyword.value=''; document.f_cari.x_keyword.focus();">Reset</a>
				</td>
			</tr>
		</table>
	</form>
	<p style="line-height:1px;margin-top:-5px;">&nbsp;</p>
	<div id="list"><?php include "pemesanan_list.php"; ?></div>
	<p class="spacer">&nbsp;</p>
<?php 
}else{
	echo "<script language='javascript'>window.location.href='index.php';</script>";
}
?>