<?php  
session_start();
include "../includes/config.php";
$db = new Database();

$user	= @$_POST['user'];
$pass	= @$_POST['pass'];
$nama	= @$_POST['nama'];

switch(@$_POST['proc']){
	case 'add' :
		$qData = "INSERT INTO _admin VALUES ('$user', MD5('$pass'), '$nama')";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Tambah data berhasil";
		else $_SESSION['s_message'] = "Tambah data gagal";
		break;
	case 'update' :
		if($pass=="") 
			$qData = "UPDATE _admin SET nama = '$nama' WHERE usernames = '$user'";
		else $qData = "UPDATE _admin SET passwords = MD5('$pass'), nama = '$nama' WHERE usernames = '$user'";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Update data berhasil";
		else $_SESSION['s_message'] = "Update data gagal";
		break;
	case 'delete' :
		$qData = "DELETE FROM _admin WHERE usernames = '$user'";
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Hapus data berhasil";
		else $_SESSION['s_message'] = "Hapus data gagal";
		break;
}

header("location:admin_list.php?ajax=true");
?>