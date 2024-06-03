<?php
session_start();
include "../includes/config.php";
$db = new Database();

$user	= @$_POST['user'];
$pass	= @$_POST['pass'];

switch(@$_POST['proc']){
	case 'login' :
		$qData = "SELECT email, nama, foto FROM _customer WHERE email = '$user' AND passwords = MD5('$pass')";
		$hqData = $db->sql($qData);
		$rData = $db->num_rows($hqData);
		list($email, $nama, $foto) = $db->fetch_row($hqData);
		
		if($rData == '0'){
			$_SESSION['s_message'] = "Email atau Password tidak valid !";
			header("location: login.php");
		}else{
			$_SESSION['s_emailCust'] 	= $email;
			$_SESSION['s_namaCust'] 	= $nama;
			$_SESSION['s_fotoCust'] 	= "users/".$foto;
			
			header("location: user.php?ajax=true");
		}
		break;
	case 'logout' :
		session_destroy();
		echo "<script language='javascript'>window.location.href='index.php';</script>";
		break;
}
?>