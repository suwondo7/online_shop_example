<?php  
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

$id		= @$_POST['id'];
$nama 	= @$_POST['nama'];

switch(@$_POST['proc']){
	case 'add' :
		$qData = "INSERT INTO _baju_merk VALUES ('".uniqid("MERK")."', '$nama')";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Tambah data berhasil";
		else $_SESSION['s_message'] = "Tambah data gagal";
		break;
	case 'update' :
		$qData = "UPDATE _baju_merk SET nama = '$nama' WHERE id_baju_merk = '$id'";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Update data berhasil";
		else $_SESSION['s_message'] = "Update data gagal";
		break;
	case 'delete' :
		$qData = "DELETE FROM _baju_merk WHERE id_baju_merk = '$id'";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Hapus data berhasil";
		else $_SESSION['s_message'] = "Hapus data gagal";
		break;
}

header("location:baju_merk_list.php?ajax=true");
?>