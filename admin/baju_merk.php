<?php session_start(); ?>
<?php 	
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

if(isset($_SESSION['s_userAdmin'])){
	$_SESSION['s_adminPage'] = "baju_merk.php";
		
	if(@$_POST['id'] != ''){
		$qEditBajuMerk = "SELECT * FROM _baju_merk WHERE id_baju_merk = '$_POST[id]'"; //echo $qEditBajuMerk;
		$dataEdit = $db->sql($qEditBajuMerk);
		$hasilEdit = $db->fetch_assoc($dataEdit);
	}
	?>
	<h2>DATA MERK BAJU</h2>
	<?php if(@$_POST['add'] != 'false'){ ?><a onclick="javascript: $('#inputan').slideDown(1000); document.getElementById('txtmerk').focus(); $(this).hide(1000);"><img src="../images/plus.png">&nbsp;Tambah&nbsp;Data</a><?php } ?>
	<div class="spacer">&nbsp;</div>
	<div id="inputan" <?php if(@$_POST['add'] != 'false') echo "style='display:none;'"; else echo "style='display:block;'"; ?>>
	<form name="form_merk" action="javascript: void(null);">
		<input type="hidden" id="hdid" <?php if(@$_POST['id'] != '') echo "value='".$hasilEdit['id_baju_merk']."'"; ?> />
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>Merk&nbsp;Baju&nbsp;</td>
				<td>&nbsp;:&nbsp;</td>
				<td>
					<input type="text" name="txtmerk" id="txtmerk" size="30" value="<?php if(@$_POST['id'] == '') echo ""; else echo $hasilEdit['nama']; ?>" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td colspan="3" align="left">
					<?php if(@$_POST['id'] != '') {?>
					<input type="button" class="button" onclick="javascript: sendRequest('baju_merk.php', 'add=false', 'content', 'div', '../images/loader.gif');" value="Tambah baru" />
					<input type="button" class="button" onclick="javascript:
						var obj = document.form_merk;
						var err = '';
						if(obj.txtmerk.value=='') err=err+'Merk harus di isi\n';		
						if(err==''){
							sendRequest('baju_merk_proses.php', 'proc=update&id='+obj.hdid.value+'&nama='+obj.txtmerk.value, 'list', 'div', '../images/loader.gif');
						}else{ 
							alert(err);
							obj.txtmerk.focus();
						}
						obj.txtmerk.value='';
					" value="Update" />
					<?php } else { ?>
					<input type="button" class="button" onclick="javascript:
						var obj = document.form_merk;
						var err = '';			
						if(obj.txtmerk.value=='') err=err+'Merk harus di pilih\n';			
						if(err==''){
							sendRequest('baju_merk_proses.php', 'proc=add&id='+obj.hdid.value+'&nama='+obj.txtmerk.value, 'list', 'div', '../images/loader.gif');
						}else{ 
							alert(err);
							obj.txtmerk.focus();
						}						
						obj.txtmerk.value='';
						obj.txtmerk.focus();
					" value="Simpan" />
					<?php } ?>
					<?php if(@$_POST['id'] == '') {?>
					<input type="reset" class="button" value="Reset" onclick="javascript: document.getElementById('txtmerk').focus();" />
					<?php } ?>
					<input type="button" class="button" onclick="javascript: sendRequest('baju.php', 'add=false', 'content', 'div', '../images/loader.gif');" value="Kembali" />
				</td>
			</tr>
		</table>
	</form>
	<p class="separator">&nbsp;</p>
	</div>
	<form name="f_cari" action="javascript: void(null);">
		<table>
			<tr>
				<td>Pencarian</td>
				<td>:</td>
				<td><input type="text" name="x_keyword" value="<?php echo @$_POST['keyword']; ?>" autocomplete="off" onkeyup="javascript: /*if(event.keyCode=='13')*/ sendRequest('baju_merk_list.php', 'ajax=true&keyword='+this.value, 'list', 'div', '../images/loader.gif');" /></td>
				<td>
					<input type="button" class="button" value="Cari" onClick="javascript: sendRequest('baju_merk_list.php', 'ajax=true&keyword='+document.f_cari.x_keyword.value, 'list', 'div', '../images/loader.gif');" />
					<a href="#reset" onclick="javascript: sendRequest('baju_merk_list.php', 'ajax=true&', 'list', 'div'); document.f_cari.x_keyword.value=''; document.f_cari.x_keyword.focus();">Reset</a>
				</td>
			</tr>
		</table>
	</form>
	<p style="line-height:1px;margin-top:-5px;">&nbsp;</p>
	<div id="list"><?php include "baju_merk_list.php"; ?></div>
	<p class="spacer">&nbsp;</p>
<?php 
}else{
	echo "<script language='javascript'>window.location.href='index.php';</script>";
}
?>