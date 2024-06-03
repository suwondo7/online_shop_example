<?php
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$email 			= @$_SESSION['s_emailCust'];
$nama 			= @$_POST['nama'];
$pass			= @$_POST['pass'];
$kelamin		= @$_POST['kelamin'];
$alamat			= @$_POST['alamat'];
$telepon		= @$_POST['telepon'];

switch(@$_POST['proc']){
	case 'update_photo' :
		//Hapus foto lama
		list($foto) = $db->result_row("SELECT foto FROM _customer WHERE email = '$email'");
		if(file_exists("../users/".$foto)){
			unlink("../users/".$foto);
		}
		//Uploading foto...
		$idImg 	= uniqid("CUST");
		$asal 	= $_FILES['ffoto']['tmp_name'];
		$tujuan = "../users/photos/".$idImg.$_FILES['ffoto']['name'];
		move_uploaded_file($asal, $tujuan);
		
		$_SESSION['s_fotoCust'] = "users/photos/".$idImg.$_FILES['ffoto']['name'];
		//Update database
		$db->sql("UPDATE _customer SET foto = '$tujuan' WHERE email = '$email'");
		header("location:profil_foto.php");
		break;
	
	case 'update' :
		$qData = "	UPDATE _customer 
					SET nama			= '$nama', ";
		if($pass != "") $qData .= " passwords	= MD5('$pass'), ";	
		$qData .= "		gender 	= '$kelamin',
						alamat	= '$alamat',
						telepon	= '$telepon'
					WHERE email = '$email'		
				 ";		
		$hqData = $db->sql($qData);
		$_SESSION['s_namaCust'] = $nama;
		//header("location:profil.php");
		echo "<script>window.top.location.reload();</script>";
		break;
}
?>