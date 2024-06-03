<?php session_start(); ?>
<?php 	
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

if(isset($_SESSION['s_userAdmin'])){
	$_SESSION['s_adminPage'] = "admin.php";
		
	if(@$_POST['id'] != ''){
		$qEditAdmin = "SELECT * FROM _admin WHERE usernames = '$_POST[id]'"; //echo $qEditAdmin;
		$dataEdit = $db->sql($qEditAdmin);
		$hasilEdit = $db->fetch_assoc($dataEdit);
	}
	?>
	<h2>DATA ADMIN</h2>
	<?php if(@$_POST['add'] != 'false'){ ?><a onclick="javascript: $('#inputan').slideDown(1000); document.getElementById('txtuser').focus(); $(this).hide(1000);"><img src="../images/plus.png">&nbsp;Tambah&nbsp;Data</a><?php } ?>
	<div class="spacer">&nbsp;</div>
	<div id="inputan" <?php if(@$_POST['add'] != 'false') echo "style='display:none;'"; else echo "style='display:block;'"; ?>>
	<form name="form_admin" action="javascript: void(null);">
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>User&nbsp;</td>
				<td>&nbsp;:&nbsp;</td>
				<td>
					<input type="text" id="txtuser" <?php if(@$_POST['id'] == '') echo "value=''"; else { echo "value='".@$hasilEdit['usernames']."'"; echo " readonly "; } ?> autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td>Password&nbsp;</td>
				<td>&nbsp;:&nbsp;</td>
				<td>
					<input type="password" id="txtpass" value="" onkeyup="javascript: if(this.value!='') $('#pass_mess').fadeOut(500); else $('#pass_mess').fadeIn(500);"/>&nbsp;
					<?php if(@$_POST['id'] != ''){ ?>
					<span id="pass_mess" style="font-size:10px; color:#f00;text-decoration:blink;">*) <i>Kosongi jika tidak ingin mengubah password</i></span>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td>Nama&nbsp;</td>
				<td>&nbsp;:&nbsp;</td>
				<td>
					<input type="text" id="txtnama" value="<?php if(@$_POST['id'] == '') echo ""; else echo @$hasilEdit['nama']; ?>" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td colspan="3" align="left">
					<?php if(@$_POST['id'] != '') {?>
					<input type="button" class="button" onclick="javascript: window.location.href='#add'; sendRequest('admin.php', 'add=false', 'content', 'div', '../images/loader.gif');" value="Tambah baru" />
					<input type="button" class="button" onclick="javascript:
						var obj = document.form_admin;
						var err = '';			
						if(obj.txtuser.value=='') err=err+'User harus di isi\n';
						if(obj.txtnama.value=='') err+='Nama harus di isi\n';			
						if(err==''){
							sendRequest('admin_proses.php', 'proc=update&user='+obj.txtuser.value+'&pass='+obj.txtpass.value+'&nama='+obj.txtnama.value, 'list', 'div', '../images/loader.gif');
						}else{ 
							alert(err);
							obj.txtuser.focus();
						}
						obj.txtuser.value='';
						obj.txtpass.value='';
						obj.txtnama.value='';
					" value="Update" />
					<?php } else { ?>
					<input type="button" class="button" onclick="javascript:
						var obj = document.form_admin;
						var err = '';			
						if(obj.txtuser.value=='') err=err+'User harus di isi\n';
						if(obj.txtnama.value=='') err+='Nama harus di isi\n';		
						if(err==''){
							sendRequest('admin_proses.php', 'proc=add&user='+obj.txtuser.value+'&pass='+obj.txtpass.value+'&nama='+obj.txtnama.value, 'list', 'div', '../images/loader.gif');
						}
						else { 
							alert(err);
							obj.txtuser.focus();
						}
						obj.txtuser.value='';
						obj.txtpass.value='';
						obj.txtnama.value='';
						obj.txtuser.focus();
					" value="Simpan" />
					<?php } ?>
					<?php if(@$_POST['id'] == '') {?>
					<input type="reset" class="button" value="Reset" />
					<?php } ?>
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
				<td><input type="text" name="x_keyword" value="<?php echo @$_POST['keyword']; ?>" autocomplete="off" onkeyup="javascript: /*if(event.keyCode=='13')*/ sendRequest('admin_list.php', 'ajax=true&keyword='+this.value, 'list', 'div', '../images/loader.gif');" /></td>
				<td>
					<input type="button" class="button" value="Cari" onClick="javascript: sendRequest('admin_list.php', 'ajax=true&keyword='+document.f_cari.x_keyword.value, 'list', 'div', '../images/loader.gif');" />
					<a href="#reset" onclick="javascript: sendRequest('admin_list.php', 'ajax=true&', 'list', 'div', '../images/loader.gif'); document.f_cari.x_keyword.value=''; document.f_cari.x_keyword.focus();">Reset</a>
				</td>
			</tr>
		</table>
	</form>
	<p style="line-height:1px;margin-top:-5px;">&nbsp;</p>
	<div id="list"><?php include "admin_list.php"; ?></div>
	<p class="spacer">&nbsp;</p>
<?php 
}else{
	echo "<script language='javascript'>window.location.href='index.php';</script>";
}
?>