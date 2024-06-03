<?php 
session_start();
include "../includes/config.php";
$db = new Database();

$_SESSION['s_page'] = "users/register.php";
?>
<h2>Pendaftaran Member</h2>
<iframe src="users/register_isi.php" frameborder="0" scrolling="no" width="500" height="480"></iframe>