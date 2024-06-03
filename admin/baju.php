<?php session_start(); ?>
<?php 	
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

if(isset($_SESSION['s_userAdmin'])){
	$_SESSION['s_adminPage'] = "baju.php";
	?>
	<h2>DATA BAJU</h2>
	<?php if(@$_POST['add'] != 'false'){ ?>
	<div id="add">
		<a onclick="javascript: $('#inputan').slideDown(1000); document.getElementById('iframe_baju').src='baju_add.php?id=<?php echo $_POST['id']; ?>'; document.getElementById('iframe_baju').width='600px'; document.getElementById('iframe_baju').height='275px'; /*document.getElementById('iframe_baju').contentDocument.getElementById('txtid').focus();*/ $('#add').hide(1000);"><img src="../images/plus.png" />&nbsp;Tambah&nbsp;Data</a>
		<a onclick="javascript: $('#inputan').slideDown(1000); document.getElementById('iframe_baju').src='baju_addcsv.php'; document.getElementById('iframe_baju').width='600px'; document.getElementById('iframe_baju').height='95px'; $('#add').hide(1000);"><img src="../images/plus.png" />&nbsp;Upload&nbsp;Data</a>
	</div>
	<?php } ?>
	<div class="spacer">&nbsp;</div>
	<div id="inputan" <?php if(@$_POST['add'] != 'false') echo "style='display:none;'"; else echo "style='display:block;'"; ?>>
		<iframe name="iframe_baju" id="iframe_baju" <?php if(@$_POST['add']=='false'){ ?>src="baju_add.php?id=<?php echo @$_POST['id']; ?>" width="600px" height="275px" <?php } ?> frameborder="0" scrolling="no"></iframe>
		<p class="separator">&nbsp;</p>
	</div>
	<form name="f_cari" action="javascript: void(null);">
		<table>
			<tr>
				<td>Pencarian</td>
				<td>:</td>
				<td><input type="text" name="x_keyword" value="<?php echo @$_POST['keyword']; ?>" autocomplete="off" onkeyup="javascript: /*if(event.keyCode=='13')*/ sendRequest('baju_list.php', 'ajax=true&keyword='+this.value, 'list', 'div', '../images/loader.gif');" /></td>
				<td>
					<input type="button" class="button" value="Cari" onClick="javascript: sendRequest('baju_list.php', 'ajax=true&keyword='+document.f_cari.x_keyword.value, 'list', 'div');" />
					<a href="#reset" onclick="javascript: sendRequest('baju_list.php', 'ajax=true&', 'list', 'div', '../images/loader.gif'); document.f_cari.x_keyword.value=''; document.f_cari.x_keyword.focus();">Reset</a>
				</td>
			</tr>
		</table>
	</form>
	<p style="line-height:1px;margin-top:-5px;">&nbsp;</p>
	<div id="list"><?php include "baju_list.php"; ?></div>
	<p class="spacer">&nbsp;</p>
<?php 
}else{
	echo "<script language='javascript'>window.location.href='index.php';</script>";
}
?>