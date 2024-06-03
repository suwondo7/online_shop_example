<?php  
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$id	= @$_POST['id'];

switch(@$_POST['proc']){
	case 'delete' :
		//Hapus foto lama
		list($foto) = $db->result_row("SELECT foto FROM _customer WHERE email = '$_POST[id]'");
		if(file_exists("../users/".$foto)){
			unlink("../users/".$foto);
		}
		$qData = "DELETE FROM _customer WHERE email = '$id'";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Hapus data berhasil";
		else $_SESSION['s_message'] = "Hapus data gagal";
		break;
}

header("location:customer_list.php?ajax=true");
?>