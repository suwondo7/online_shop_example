<?php  
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$id	= @$_POST['id'];

switch(@$_POST['proc']){
	case 'status' :
		$qData = "UPDATE _pemesanan SET status = '1' WHERE id_pemesanan = '$id'";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Update data berhasil";
		else $_SESSION['s_message'] = "Update data gagal";
		break;
	case 'delete' :
		//Hapus dari detail pemesanan
		$qData = "DELETE FROM _pemesanan_detail WHERE id_pemesanan = '$id'";
		$hqData = $db->sql($qData);
		
		//Hapus dari pemesanan
		$qData = "DELETE FROM _pemesanan WHERE id_pemesanan = '$id'";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Hapus data berhasil";
		else $_SESSION['s_message'] = "Hapus data gagal";
		break;
}

header("location:pemesanan_list.php?ajax=true");
?>