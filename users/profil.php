<?php session_start(); ?>
<?php 	
if(isset($_SESSION['s_emailCust'])){
	include "../includes/config.php";
	include "../includes/functions.php";
	$db = new Database();
	$func = new Functions();
	
	$_SESSION['s_page'] = "users/profil.php";
	
	$hasilEdit = $db->fetch_assoc($db->sql("SELECT * FROM _customer WHERE email = '".@$_SESSION['s_emailCust']."'"));
}
?>
<h2>Profil Customer</h2>
<div>
	<?php
	switch(@$_POST['proc']){
		case 'edit' :
			?>
			<table style="margin:10px 10px 10px 10px; font-size:12px;">
				<tr>
					<td rowspan="9" valign="top">
						<iframe src="users/profil_foto.php" frameborder="0" scrolling="no" width="92" height="112"></iframe>
						<p style="text-align:center">Foto 3x4</p>
					</td>
					<td rowspan="9">&nbsp;</td>
					<td>Email</td>
					<td>&nbsp;:&nbsp;</td>
					<td><b><?php echo $hasilEdit['email']; ?></b></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>&nbsp;:&nbsp;</td>
					<td><input type="text" name="txtnama" id="txtnama" value="<?php echo $hasilEdit['nama']; ?>" /></td>
				</tr>
				<tr>
					<td valign="top">Password</td>
					<td valign="top">&nbsp;:&nbsp;</td>
					<td>
						<input type="password" name="txtpass" id="txtpass" value="" onkeyup="javascript: var $j = jQuery.noConflict(); if(this.value!='') $j('#pass_mess').fadeOut(500); else $j('#pass_mess').fadeIn(500);"/><br>
						<span id="pass_mess" style="font-size:10px; color:#f00;text-decoration:blink;">*) <i>Kosongi jika tidak ingin mengubah password</i></span>
					</td>
				</tr>
				<tr>
					<td>Jenis&nbsp;Kelamin</td>
					<td>&nbsp;:&nbsp;</td>
					<td>
						<input type="radio" name="rdkelamin" id="rdkelaminl" value="1" <?php if($hasilEdit['gender']=='1') echo "checked"; ?> onclick="javascript: document.getElementById('hdkelamin').value='1';" />&nbsp;Laki - laki
						<input type="radio" name="rdkelamin" id="rdkelaminp" value="0" <?php if($hasilEdit['gender']=='0') echo "checked"; ?> onclick="javascript: document.getElementById('hdkelamin').value='0';" />&nbsp;Perempuan
						<input type="hidden" name="hdkelamin" id="hdkelamin" value="<?php echo $hasilEdit['gender']; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top">Alamat</td>
					<td valign="top">&nbsp;:&nbsp;</td>
					<td valign="top"><textarea name="txtalamat" id="txtalamat"><?php echo $hasilEdit['alamat']; ?></textarea></td>
				</tr>
				<tr>
					<td>Telepon/Handphone</td>
					<td>&nbsp;:&nbsp;</td>
					<td><input type="text" name="txttelepon" id="txttelepon" value="<?php echo $hasilEdit['telepon']; ?>" /></td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<input type="button" class="button" value="Cancel" onclick="javascript: sendRequest('users/profil.php', '', 'content', 'div');" />
						<input type="button" class="button" value="Update" onclick="javascript:
						sendRequest('users/profil_proses.php', 'proc=update&nama='+document.getElementById('txtnama').value+'&pass='+document.getElementById('txtpass').value+'&kelamin='+document.getElementById('hdkelamin').value+'&alamat='+document.getElementById('txtalamat').value+'&telepon='+document.getElementById('txttelepon').value, 'content', 'div', '');
						" />
					</td>
				</tr>
			</table>
			<?php
			break;
		
		default :
			?>
			<table style="margin:10px 10px 10px 10px; font-size:12px;">
				<tr>
					<td rowspan="8" valign="top">
						<?php
						if(!file_exists("../users/".$hasilEdit['foto'])){
							echo "<img src='images/fotokosong.gif' width='90' height='110' border='1' />";
						}else{
							echo "<img src='users/$hasilEdit[foto]' width='90' height='110' border='1' />";
						} 
						?>
						<p align="center"><a onclick="javascript: sendRequest('users/profil.php', 'proc=edit', 'content', 'div', '');"><img src="images/icon-tag.gif" width="16" height="12"  title="<?php echo $hasilEdit['nama']; ?>" />&nbsp;Edit</a></p>
					</td>
					<td rowspan="8">&nbsp;</td>
					<td>Email</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?php echo $hasilEdit['email'];; ?></td>
				</tr>	
				<tr>
					<td>Nama</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?php echo $hasilEdit['nama'];; ?></td>
				</tr>				
				<tr>
					<td>Gender</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?php if($hasilEdit['gender']=='1') echo "Laki - laki"; else echo "Perempuan"; ?></td>
				</tr>				
				<tr>
					<td valign="top">Alamat</td>
					<td valign="top">&nbsp;:&nbsp;</td>
					<td valign="top"><?php echo $hasilEdit['alamat']; ?></td>
				</tr>
				<tr>
					<td>Telepon/Handphone&nbsp;</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?php echo $hasilEdit['telepon'];; ?></td>
				</tr>
			</table>
			<?php
			break;
	}
	?>
</div>
<div class="cleaner"></div>