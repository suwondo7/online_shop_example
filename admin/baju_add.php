<?php 	
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();
?>
<html>
	<head>
		<!-- JQuery dan AJAX-->
		<script type="text/javascript" src="../includes/ajax.js"></script>
		<script type="text/javascript" src="../includes/jquery-1.4.2.min.js"></script>
		<!-- End of JQuery dan AJAX -->
				
		<!-- Admin CSS -->
		<style type="text/css">
			body{ font-family:verdana; font-size:10px;	}
			form table tr td{ font-size:11px; color:#999; }
			form table tr td a{ text-decoration:none; cursor:pointer; }
			form table tr td select{ font-size:11px; color:#999; }
			.button{ background-color:rgb(38, 114, 236); font-size: 14px; color:white; border:none; padding:2px 10px 2px 10px; }
.button:hover{ background-color:rgb(58, 154, 246); }
		</style>
		<!-- End of Admin CSS -->
	</head>
<body>
	<?php
	if(@$_GET['id'] != ''){
		$qEditBaju = "SELECT * FROM _baju WHERE id_baju = '$_GET[id]'"; //echo $qEditBaju;
		$dataEdit = $db->sql($qEditBaju);
		$hasilEdit = $db->fetch_assoc($dataEdit);
	}
	?>
	<form name="form_baju" method="POST" action="baju_proses.php" enctype="multipart/form-data">
		<?php if(@$_GET['id'] == ''){ ?>
		<input type="hidden" id="proc" name="proc" value="add" />
		<?php }else{ ?>
		<input type="hidden" id="proc" name="proc" value="update" />
		<input type="hidden" id="txtid" name="txtid" value="<?php echo @$hasilEdit['id_baju']; ?>" />
		<?php } ?>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top">Nama&nbsp;Baju&nbsp;</td>
				<td valign="top">&nbsp;:&nbsp;</td>
				<td>
					<input type="text" name="txtnama" id="txtnama" size="30" value="<?php if(@$_GET['id'] == '') echo ""; else echo @$hasilEdit['nama']; ?>" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td valign="top">Kategori&nbsp;Baju&nbsp;</td>
				<td valign="top">&nbsp;:&nbsp;</td>
				<td>
					<select name="cbkategori" id="cbkategori">
						<option value="0">-- Pilih Kategori --</option>
						<?php
						$qData = "SELECT id_baju_kategori, nama FROM _baju_kategori ORDER BY nama ASC";
						$hqData = $db->sql($qData);
						while(list($idBajuKategori, $namaKategori) = $db->fetch_row($hqData)){
							echo "<option value='$idBajuKategori'";
							if($idBajuKategori == @$hasilEdit['id_baju_kategori']) echo " selected ";
							echo ">$namaKategori</option>";
						}
						$db->close($hqData);
						?>
					</select>&nbsp;
					<img src="../images/users.gif" />&nbsp;<a style="cursor:pointer;" onclick="javascript: window.top.sendRequest('baju_kategori.php', '', 'content', 'div', '../images/loader.gif');">Tambah&nbsp;Kategori</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Merk&nbsp;Baju&nbsp;</td>
				<td valign="top">&nbsp;:&nbsp;</td>
				<td>
					<select name="cbmerk" id="cbmerk">
						<option value="0">-- Pilih Merk --</option>
						<?php
						$qData = "SELECT id_baju_merk, nama FROM _baju_merk ORDER BY nama ASC";
						$hqData = $db->sql($qData);
						while(list($idBajuMerk, $namaMerk) = $db->fetch_row($hqData)){
							echo "<option value='$idBajuMerk'";
							if($idBajuMerk == @$hasilEdit['id_baju_merk']) echo " selected ";
							echo ">$namaMerk</option>";
						}
						$db->close($hqData);
						?>
					</select>&nbsp;
					<img src="../images/users.gif" />&nbsp;<a style="cursor:pointer;" onclick="javascript: window.top.sendRequest('baju_merk.php', '', 'content', 'div', '../images/loader.gif');">Tambah&nbsp;Merk</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Foto&nbsp;</td>
				<td valign="top">&nbsp;:&nbsp;</td>
				<td>
				<?php 
				if(@$_GET['id'] == ''){ 
					echo "<input class='button' type='file' name='ffoto' id='ffoto' />";
				}else{ 
					if(!file_exists(@$hasilEdit['foto'])){
						echo "<input class='button' type='file' name='ffoto' id='ffoto' />";
					}else{
						echo "<a onclick=\"javascript: $('#ffoto').fadeIn(1000); $(this).hide(500); \"><img src='$hasilEdit[foto]' width='50' height='35' border='1'/></a>";
						echo "<input class='button' type='file' name='ffoto' id='ffoto' style='display:none;' />";
					}
				} 
				?>
				</td>
			</tr>
			<tr>
				<td valign="top">Warna&nbsp;</td>
				<td valign="top">&nbsp;:&nbsp;</td>
				<td>
					<input type="text" name="txtwarna" id="txtwarna" size="30" value="<?php if(@$_GET['id'] == '') echo ""; else echo @$hasilEdit['warna']; ?>" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td valign="top">Ukuran&nbsp;</td>
				<td valign="top">&nbsp;:&nbsp;</td>
				<td>
					<input type="text" name="txtukuran" id="txtukuran" size="10" value="<?php if(@$_GET['id'] == '') echo ""; else echo @$hasilEdit['ukuran']; ?>" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td valign="top">Harga&nbsp;</td>
				<td valign="top">&nbsp;:&nbsp;</td>
				<td>
					Rp.&nbsp;<input type="text" name="txtharga" id="txtharga" size="20" value="<?php if(@$_GET['id'] == '') echo ""; else echo @$hasilEdit['harga']; ?>" autocomplete="off" onkeyup="javascript: if(isNaN(this.value)) { alert('Harus angka'); this.value=''; }" />
				</td>
			</tr>
			<tr>
				<td valign="top">Keterangan&nbsp;</td>
				<td valign="top">&nbsp;:&nbsp;</td>
				<td>
					<textarea name="txtketerangan" id="txtketerangan"></textarea>
				</td>
			</tr>
			<tr>
				<td valign="top">Stok&nbsp;</td>
				<td valign="top">&nbsp;:&nbsp;</td>
				<td>
					<input type="text" name="txtstok" id="txtstok" size="10" value="<?php if(@$_GET['id'] == '') echo ""; else echo @$hasilEdit['stok']; ?>" autocomplete="off" onkeyup="javascript: if(isNaN(this.value)) { alert('Harus angka'); this.value=''; }" />
				</td>
			</tr>
			<tr>
				<td colspan="3" align="left">
					<?php if(@$_GET['id'] != '') {?>
					<input type="button" class="button" onclick="javascript: window.location.href='#add'; window.parent.sendRequest('baju.php', 'add=false', 'content', 'div', '../images/loader.gif');" value="Tambah baru" />
					<input type="button" class="button" onclick="javascript:
						var obj = document.form_baju;
						var err = '';
						if(obj.txtnama.value=='') err=err+'Nama harus di isi\n';	
						if(obj.cbkategori.value=='0') err=err+'Kategori harus di isi\n';		
						if(obj.cbmerk.value=='0') err=err+'Merk harus di isi\n';		
						if(obj.txtwarna.value=='') err=err+'Warna harus di isi\n';		
						if(obj.txtukuran.value=='') err=err+'Ukuran harus di isi\n';		
						if(obj.txtharga.value=='') err=err+'Harga harus di isi\n';		
						if(obj.txtstok.value=='') err=err+'Stok harus di isi\n';		
						if(err==''){
							obj.submit();
						}else{ 
							alert(err);
						}
					" value="Update" />
					<?php } else { ?>
					<input type="button" class="button" onclick="javascript:
						var obj = document.form_baju;
						var err = '';
						if(obj.txtnama.value=='') err=err+'Nama harus di isi\n';	
						if(obj.cbkategori.value=='0') err=err+'Kategori harus di isi\n';		
						if(obj.cbmerk.value=='0') err=err+'Merk harus di isi\n';		
						if(obj.txtwarna.value=='') err=err+'Warna harus di isi\n';		
						if(obj.txtukuran.value=='') err=err+'Ukuran harus di isi\n';		
						if(obj.txtharga.value=='') err=err+'Harga harus di isi\n';		
						if(obj.txtstok.value=='') err=err+'Stok harus di isi\n';	
						if(err==''){
							obj.submit();
						}else{ 
							alert(err);
						}
					" value="Simpan" />
					<?php } ?>
					<?php if(@$_GET['id'] == '') {?>
					<input type="reset" class="button" value="Reset" onclick="javascript: document.getElementById('txtid').focus();" />
					<?php } ?>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>