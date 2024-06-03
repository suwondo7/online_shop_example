<?php 
session_start();
include "../includes/config.php";
$db = new Database();
include "../includes/captcha/securimage.php";

$user	= @$_POST['user'];
$pass	= @$_POST['pass'];

$img = new Securimage();
echo $valid = $img->check(@$_POST['kode']);

switch(@$_POST['proc']){
	case 'login' :
		// if($valid){
		$qData = "SELECT usernames, nama FROM _admin WHERE usernames = '$user' AND passwords = MD5('$pass')";
		$hqData = $db->sql($qData, false);
		$rData = $db->num_rows($hqData);
		list($usernames, $nama) = $db->fetch_row($hqData);
		
		if($rData == '0'){
			//header("location:login.php");
			unset($_SESSION['s_stAdmin']);
			$_SESSION['s_message'] = "User / Password Salah !!!";
			echo "<script language='javascript'>window.location.href='index.php';</script>";
		}else{
			$_SESSION['s_stAdmin'] 		= true;
			$_SESSION['s_userAdmin'] 	= $usernames;
			$_SESSION['s_namaAdmin'] 	= $nama;
			
			echo "<script language='javascript'>window.location.href='index.php';</script>";
		}
		// }else{
			// $_SESSION['s_message'] = "Kode Captcha Salah !!!";
			// header("location:login.php?ajax=true");
		// }
		break;
}
?>