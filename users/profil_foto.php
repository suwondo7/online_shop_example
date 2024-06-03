<?php
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

list($nama, $foto) = $db->result_row("SELECT nama, foto FROM _customer WHERE email = '".@$_SESSION['s_emailCust']."'");
?>

<script type="text/javascript" src="../includes/jquery-1.4.2.min.js"></script>
<form id="form_foto" style="margin: -8px 0px 0px -8px;" method="POST" action="profil_proses.php" enctype="multipart/form-data">
	<input type="hidden" name="proc" id="proc" value="update_photo" />
	<a style="cursor:pointer;" onclick="javascript: $('#ffoto').click(); " title="<?php echo $nama; ?>">
	<?php if(!file_exists($foto)){ ?>	
		<img name="imgsiswa" id="imgsiswa" src="../images/fotokosong.gif" width="90" height="110" border="1" />
	<?php }else{ ?>
		<img name="imgsiswa" id="imgsiswa" src="<?php echo $foto; ?>" width="90" height="110" border="1" />
	<?php } ?>
	</a>
	<input type="file" name="ffoto" id="ffoto" style="width:1px; height:1px;" onchange="javascript: document.getElementById('form_foto').submit();" />
</form>	