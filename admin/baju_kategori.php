<?php session_start(); ?>
<?php 	
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

if(isset($_SESSION['s_userAdmin'])){
	$_SESSION['s_adminPage'] = "baju_kategori.php";
		
	if(@$_POST['id'] != ''){
		$qEditBajuKategori = "SELECT * FROM _baju_kategori WHERE id_baju_kategori = '$_POST[id]'"; //echo $qEditBajuKategori;
		$dataEdit = $db->sql($qEditBajuKategori);
		$hasilEdit = $db->fetch_assoc($dataEdit);
	}
	?>
	<h2>DATA KATEGORI BAJU</h2>
	<?php if(@$_POST['add'] != 'false'){ ?><a onclick="javascript: $('#inputan').slideDown(1000); document.getElementById('txtkategori').focus(); $(this).hide(1000);"><img src="../images/plus.png">&nbsp;Tambah&nbsp;Data</a><?php } ?>
	<div class="spacer">&nbsp;</div>
	<div id="inputan" <?php if(@$_POST['add'] != 'false') echo "style='display:none;'"; else echo "style='display:block;'"; ?>>
	<form name="form_kategori" action="javascript: void(null);">
		<input type="hidden" id="hdid" <?php if(@$_POST['id'] != '') echo "value='".@$hasilEdit['id_baju_kategori']."'"; ?> />
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>Kategori&nbsp;Baju&nbsp;</td>
				<td>&nbsp;:&nbsp;</td>
				<td>
					<input type="text" name="txtkategori" id="txtkategori" size="30" value="<?php if(@$_POST['id'] == '') echo ""; else echo $hasilEdit['nama']; ?>" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td colspan="3" align="left">
					<?php if(@$_POST['id'] != '') {?>
					<input type="button" class="button" onclick="javascript: sendRequest('baju_kategori.php', 'add=false', 'content', 'div', '../images/loader.gif');" value="Tambah baru" />
					<input type="button" class="button" onclick="javascript:
						var obj = document.form_kategori;
						var err = '';
						if(obj.txtkategori.value=='') err=err+'Kategori harus di isi\n';		
						if(err==''){
							sendRequest('baju_kategori_proses.php', 'proc=update&id='+obj.hdid.value+'&nama='+obj.txtkategori.value, 'list', 'div', '../images/loader.gif');
						}else{ 
							alert(err);
							obj.txtkategori.focus();
						}
						obj.txtkategori.value='';
					" value="Update" />
					<?php } else { ?>
					<input type="button" class="button" onclick="javascript:
						var obj = document.form_kategori;
						var err = '';			
						if(obj.txtkategori.value=='') err=err+'Kategori harus di pilih\n';			
						if(err==''){
							sendRequest('baju_kategori_proses.php', 'proc=add&id='+obj.hdid.value+'&nama='+obj.txtkategori.value, 'list', 'div', '../images/loader.gif');
						}else{ 
							alert(err);
							obj.txtkategori.focus();
						}						
						obj.txtkategori.value='';
						obj.txtkategori.focus();
					" value="Simpan" />
					<?php } ?>
					<?php if(@$_POST['id'] == '') {?>
					<input type="reset" class="button" value="Reset" onclick="javascript: document.getElementById('txtkategori').focus();" />
					<?php } ?>
					<input type="button" class="button" onclick="javascript: sendRequest('baju_kategori.php', 'add=false', 'content', 'div', '../images/loader.gif');" value="Kembali" />
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
				<td><input type="text" name="x_keyword" value="<?php echo @$_POST['keyword']; ?>" autocomplete="off" onkeyup="javascript: /*if(event.keyCode=='13')*/ sendRequest('baju_kategori_list.php', 'ajax=true&keyword='+this.value, 'list', 'div', '../images/loader.gif');" /></td>
				<td>
					<input type="button" class="button" value="Cari" onClick="javascript: sendRequest('baju_kategori_list.php', 'ajax=true&keyword='+document.f_cari.x_keyword.value, 'list', 'div', '../images/loader.gif');" />
					<a href="#reset" onclick="javascript: sendRequest('baju_kategori_list.php', 'ajax=true&', 'list', 'div'); document.f_cari.x_keyword.value=''; document.f_cari.x_keyword.focus();">Reset</a>
				</td>
			</tr>
		</table>
	</form>
	<p style="line-height:1px;margin-top:-5px;">&nbsp;</p>
	<div id="list"><?php include "baju_kategori_list.php"; ?></div>
	<p class="spacer">&nbsp;</p>
<?php 
}else{
	echo "<script language='javascript'>window.location.href='index.php';</script>";
}
?>