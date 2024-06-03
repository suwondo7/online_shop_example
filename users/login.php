<?php
session_start();
?>
<div id="message"><?php echo @$_SESSION['s_message']; ?></div>
<form name="form_member" id="form_member">
	<table>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type="text" name="txtuser" id="txtuser" size="17" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="password" name="txtpass" id="txtpass" size="17" /></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><a style="cursor:pointer" onclick="javascript: sendRequest('users/register.php', '', 'content', 'div', '');">Daftar</a></td>
			<td><input type="button" value="Masuk" onclick="javascript: sendRequest('users/login_proses.php', 'proc=login&user='+document.getElementById('txtuser').value+'&pass='+document.getElementById('txtpass').value, 'form_member', 'div', '');" /></td>
		</tr>
	</table>
</form>