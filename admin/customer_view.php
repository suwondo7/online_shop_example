<?php
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$id = @$_GET['id'];
?>
<html>
	<head>
		<title>Customer</title>
		<script type="text/javascript" src="../includes/jquery-1.4.2.min.js"></script>
		<script language="javascript">
		$(document).ready(function(){
			$(document).focus();
		});
		$(document).keyup(function(event){
			if (event.keyCode == 27) {
				window.top.tutupPopup(1000);
			}
		});
		</script>
		<link rel="stylesheet" href="../includes/popup-window/popup.css"></link>
	</head>
<body bgcolor="white">
	<?php
	$qData = "SELECT email, nama, gender, foto, alamat, telepon FROM _customer WHERE email = '$id'";
	$hqData = $db->sql($qData);
	list($email, $nama, $gender, $foto, $alamat, $telepon) = $db->fetch_row($hqData);
	?>
	<table width="100%">
		<tr>
			<td>
				<table>
					<tr>
						<td>Email&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $email; ?></td>
					</tr>
					<tr>
						<td>Nama&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $nama; ?></td>
					</tr>
					<tr>
						<td>Gender&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($gender == 'L') echo "Laki - laki"; else echo "Perempuan"; ?></td>
					</tr>
					<tr>
						<td>Alamat&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $alamat; ?></td>
					</tr>
					<tr>
						<td>Telepon/Handphone&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $telepon; ?></td>
					</tr>
					<tr>
						<td valign="top">Foto&nbsp;</td>
						<td valign="top">&nbsp;:&nbsp;</td>
						<td><img src="<?php if(file_exists("../users/".$foto)) echo "../users/".$foto; else echo "../images/fotokosong.gif"; ?>" width="80" height="100" border="1" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<input type="button" class="button" value="Tutup" onclick="javascript: window.top.tutupPopup(1000);" />
</body>
</html>