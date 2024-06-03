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
			.button{ font-size: 9px; }
		</style>
		<!-- End of Admin CSS -->
	</head>
<body>
	<form name="form_baju" id="form_baju" method="POST" action="baju_proses.php" enctype="multipart/form-data">
		<input type="hidden" name="proc" id="proc" value="upload_data" />
		<b>Format&nbsp;CSV&nbsp;:</b>&nbsp;<br>IDBaju - Nama - Kategori - Merk - Warna - Ukuran - Harga - Foto(kosongi) - Keterangan - Stok<br/><br/>
		Export&nbsp;Data&nbsp;Baju&nbsp;(CSV)&nbsp;:&nbsp;<input type="file" name="ffile" id="ffile" style="font-size:9px;" /><br/>
		<input type="button" class="button" value="Upload" onclick="javascript: if(document.form_baju.ffile.value == ''){ alert('Pilih file dulu !'); $('#ffile').click(); }else{ document.form_baju.submit(); }" />
	</form>
</body>
</html>