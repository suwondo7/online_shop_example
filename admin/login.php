<?php 
include "../includes/config.php";
$db = new Database();
 ?>
<table border="0">
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td>User</td>
		<td>:</td>
		<td><input type="text" id="txtuser" onkeyup="javascript: if(event.keyCode==13){ if(this.value=='') alert('User isi dulu donk !!!'); else document.getElementById('txtpass').focus();}" /></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" id="txtpass" onkeyup="javascript: if(event.keyCode==13){ if(this.value=='') alert('User password dulu donk !!!'); else document.getElementById('txtkode').focus(); }" /></td>
	</tr>
	<tr>
		<td colspan="3">
			<div style="width:180px; height:50px; border:1px groove white;">
				<img id="siimage" align="left" style="padding-right: 5px; border: 0" src="../includes/captcha/securimage_show.php?sid=<?php echo md5(time()) ?>" width="145" height="50" />
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="movie" value="../includes/captcha/securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
					<param name="quality" value="high" />	
					<param name="bgcolor" value="#ffffff" />
					<embed src="../includes/captcha/securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
				</object>
				<br />
					
				<!-- pass a session id to the query string of the script to prevent ie caching -->
				<a tabindex="-1" style="border-style: none" title="Refresh Image" href="#" onClick="document.getElementById('siimage').src = '../includes/captcha/securimage_show.php?sid=' + Math.random(); return false">
				<img src="../includes/captcha/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
			</div>
		</td>
	</tr>
	<tr>
		<td>Kode</td>
		<td>:</td>
		<td><input type="text" id="txtkode" onkeyup="javascript: if(event.keyCode==13){ if(this.value=='') alert('User kode dulu donk !!!'); else sendRequest('login_proses.php', 'proc=login&user='+document.getElementById('txtuser').value+'&pass='+document.getElementById('txtpass').value+'&kode='+document.getElementById('txtkode').value, 'login', 'div', '../images/loader.gif'); }" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="button" value="Enter" style="background-color:#efe7fa;" onclick="javascript: sendRequest('login_proses.php', 'proc=login&user='+document.getElementById('txtuser').value+'&pass='+document.getElementById('txtpass').value+'&kode='+document.getElementById('txtkode').value, 'login', 'div', '../images/loader.gif'); " /></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
</table>