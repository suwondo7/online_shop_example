<html>
	<body>
		<?php
		if(@$_GET['status'] == 'ok'){
			echo "<p>Terima kasih telah melakukan pendaftaran, silahkan masuk sebagai member area dan selamat berbelanja.</p>";
		}else{
		?>
		<form name="form_register" id="form_register" method="POST" action="register_proses.php" enctype="multipart/form-data">
			<input type="hidden" name="proc" id="proc" value="add" />
			<table width="100%">
				<tr>
					<td>Email</td>
					<td>:</td>
					<td>
						<input type="text" name="txtemail" id="txtemail" onkeyup="javascript: 
						var RegExp = /^((([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+(\.([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+)*)@((((([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.))*([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.)[\w]{2,4}|(((([0-9]){1,3}\.){3}([0-9]){1,3}))|(\[((([0-9]){1,3}\.){3}([0-9]){1,3})\])))$/ 
						if(RegExp.test(this.value)){
							document.getElementById('cekemail').innerHTML='<img src=\'../images/approve.png\' />&nbsp;Email valid';
							document.getElementById('cekemail').style.color='green';
							document.getElementById('hdcekemail').value='1';
						}else{
							document.getElementById('cekemail').innerHTML='<img src=\'../images/novalid.png\' />&nbsp;Email tidak valid';
							document.getElementById('cekemail').style.color='red';
							document.getElementById('cekemail').value='0';
						}" autocomplete="off"/>&nbsp;
						<input type="hidden" name="hdcekemail" id="hdcekemail" value="0" />
						<div id="cekemail" style="display:inline;"></div>
					</td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td>
						<input type="password" name="txtpass" id="txtpass" onkeyup="javascript: 
						if((this.value).length >= 7){
							document.getElementById('cekpass').innerHTML='<img src=\'../images/approve.png\' />&nbsp;Password Ok';
							document.getElementById('cekpass').style.color='green';
							document.getElementById('hdcekpass').value='1';
						}else{
							document.getElementById('cekpass').innerHTML='<img src=\'../images/novalid.png\' />&nbsp;Password minimal 7 huruf';
							document.getElementById('cekpass').style.color='red';
							document.getElementById('hdcekpass').value='0';
						}"/>&nbsp;
						<input type="hidden" name="hdcekpass" id="hdcekpass" value="0" />
						<div id="cekpass" style="display:inline;"></div>
					</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>
						<input type="text" name="txtnama" id="txtnama" onblur="javascript: 
						if(this.value!=''){
							document.getElementById('ceknama').innerHTML='<img src=\'../images/approve.png\' />&nbsp;Nama Ok';
							document.getElementById('ceknama').style.color='green';							
							document.getElementById('hdceknama').value='1';
						}else{
							document.getElementById('ceknama').innerHTML='<img src=\'../images/novalid.png\' />&nbsp;Nama tidak boleh kosong';
							document.getElementById('ceknama').style.color='red';
							document.getElementById('hdceknama').value='0';
						}" autocomplete="off" />&nbsp;
						<input type="hidden" name="hdceknama" id="hdceknama" value="0" />
						<div id="ceknama" style="display:inline;"></div>
					</td>
				</tr>
				<tr>
					<td>Gender</td>
					<td>:</td>
					<td>
						<input type="radio" name="txtgender" id="txtgenderl" value="1" />Laki - laki
						<input type="radio" name="txtgender" id="txtgender2" value="0" checked />Perempuan
					</td>
				</tr>
				<tr>
					<td valign="top">Alamat</td>
					<td valign="top">:</td>
					<td>
						<textarea name="txtalamat" id="txtalamat" onkeyup="javascript:
						if(this.value!=''){
							document.getElementById('cekalamat').innerHTML='<img src=\'../images/approve.png\' />&nbsp;Alamat Ok';
							document.getElementById('cekalamat').style.color='green';							
							document.getElementById('hdcekalamat').value='1';
						}else{
							document.getElementById('cekalamat').innerHTML='<img src=\'../images/novalid.png\' />&nbsp;Alamat tidak boleh kosong';
							document.getElementById('cekalamat').style.color='red';
							document.getElementById('hdcekalamat').value='0';
						}"></textarea>&nbsp;
						<input type="hidden" name="hdcekalamat" id="hdcekalamat" value="0" />
						<div id="cekalamat" style="display:inline;"></div>
					</td>
				</tr>
				<tr>
					<td>Telepon</td>
					<td>:</td>
					<td>
						<input type="text" name="txttelepon" id="txttelepon" onkeyup="javascript:
						if(this.value!=''){
							document.getElementById('cektelepon').innerHTML='<img src=\'../images/approve.png\' />&nbsp;Telepon Ok';
							document.getElementById('cektelepon').style.color='green';							
							document.getElementById('hdcektelepon').value='1';
						}else{
							document.getElementById('cektelepon').innerHTML='<img src=\'../images/novalid.png\' />&nbsp;Telepon tidak boleh kosong';
							document.getElementById('cektelepon').style.color='red';
							document.getElementById('hdcektelepon').value='0';
						}"/>&nbsp;
						<input type="hidden" name="hdcektelepon" id="hdcektelepon" value="0" />
						<div id="cektelepon" style="display:inline;"></div>
					</td>
				</tr>
				<tr>
					<td>Foto</td>
					<td>:</td>
					<td><input type="file" name="txtfoto" id="txtfoto" /></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="button" value="Daftar" onclick="javascript:
					var cek = true;
					if(document.getElementById('hdcekemail').value == '0') cek = false;
					if(document.getElementById('hdcekpass').value == '0') cek = false;
					if(document.getElementById('hdceknama').value == '0') cek = false;
					if(document.getElementById('hdcekalamat').value == '0') cek = false;
					if(document.getElementById('hdcektelepon').value == '0') cek = false;
					if(cek == false){
						alert('Ada inputan yang belum valid !');
					}else{
						document.getElementById('form_register').submit();
					}
					" /></td>
					<td><input type="reset" value="Clear" /></td>
				</tr>
			</table>
		</form>
		<?php } ?>
	</body>
</html>