<?php
session_start();
include "../includes/config.php";
$db = new Database();

$email 		= @$_POST['txtemail'];
$pass		= @$_POST['txtpass'];
$nama		= @$_POST['txtnama'];
$gender		= @$_POST['txtgender'];
$alamat		= @$_POST['txtalamat'];
$telepon	= @$_POST['txttelepon'];

switch(@$_POST['proc']){
	case 'add' :
		//Buat folder
		if(!file_exists("photos")){
			mkdir("photos");
		}
		$asal	= @$_FILES['txtfoto']['tmp_name'];
		$tujuan	= "photos/".uniqid("CUST").$_FILES['txtfoto']['name'];
		move_uploaded_file($asal, $tujuan);
		
		$qData = "INSERT INTO _customer VALUES ('$email', MD5('$pass'), '$nama', '$gender', '$tujuan', '$alamat', '$telepon')";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Register data berhasil";
		else $_SESSION['s_message'] = "Register data gagal";
		break;
}

header("location:register_isi.php?status=ok");
?>