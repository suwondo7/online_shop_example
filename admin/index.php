<?php 
	session_start(); 
	include "../includes/config.php";
	$db = new Database();
?>
<html>
	<head>
		<title>Administrator Page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		
		<!-- Favicon -->
		<link rel="icon" href="../images/config.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="../images/config.ico" type="image/x-icon" />
		<!-- End of Favicon -->
		
		<!-- JQuery dan AJAX-->
		<script type="text/javascript" src="../includes/ajax.js"></script>
		<script type="text/javascript" src="../includes/jquery-1.4.2.min.js"></script>
		<!-- End of JQuery dan AJAX -->
		
		<!-- Accordion Menu -->
		<script type="text/javascript" src="../includes/accordion-menu/ddaccordion.js"></script>
		<script type="text/javascript" src="../includes/accordion-menu/accordion-init.js"></script>
		<link href="../includes/accordion-menu/accordion.css" rel="stylesheet"></link>
		<!-- End of accordion menu -->
		
		<!-- popup calendar -->
		<link rel="stylesheet" href="../includes/popup-calendar/dhtmlgoodies_calendar.css" media="screen"></link>
		<script type="text/javascript" src="../includes/popup-calendar/dhtmlgoodies_calendar.js"></script>
		<!-- End of popup calendar -->
		
		<!-- popup window -->
		<link rel="stylesheet" href="../includes/popup-window/subModal.css" media="screen"></link>
		<script type="text/javascript" src="../includes/popup-window/common.js"></script>
		<script type="text/javascript" src="../includes/popup-window/subModal.js"></script>
		<!-- End of popup window -->
		
		<!-- Admin CSS -->
		<link rel="stylesheet" type="text/css" href="../includes/admin.css"></link>
		<!-- End of Admin CSS -->
	</head>
	<?php
	if(!isset($_SESSION['s_userAdmin'])){
	?>
	<!-- Halaman Login -->
	<body>
		<script language="javascript">
			$(document).ready(function(){document.getElementById('txtuser').focus();});
		</script>
		<table width="100%" height="50%">
			<tr>
				<td align="center" valign="bottom">
					<div id="header-login" style="margin-bottom:30px; color:#cc1a00;">
						<p>Halaman <b><i>Administrator</i></b></p>
					</div>
					<div id="login">
						<table border="0">
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td>User</td>
								<td>:</td>
								<td><input type="text" id="txtuser" onkeyup="javascript: if(event.keyCode==13){ if(this.value=='') alert('User isi dulu donk !!!'); else document.getElementById('txtpass').focus();}" /></td>
							</tr>
							<tr>
								<td>Password</td>
								<td>:</td>
								<td><input type="password" id="txtpass" onkeyup="javascript: if(event.keyCode==13){ if(this.value=='') alert('User password dulu donk !!!'); else document.getElementById('txtkode').focus(); }" /></td>
							</tr>
							<tr>
								<td colspan="3">
									<div style="width:180px; height:50px; border:1px groove white;">
										<img id="siimage" align="left" style="padding-right: 5px; border: 0" src="../includes/captcha/securimage_show.php?sid=<?php echo md5(time()) ?>" width="145" height="50" />
										<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
											<param name="allowScriptAccess" value="sameDomain" />
											<param name="allowFullScreen" value="false" />
											<param name="movie" value="../includes/captcha/securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
											<param name="quality" value="high" />	
											<param name="bgcolor" value="#ffffff" />
											<embed src="../includes/captcha/securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
										</object>
										<br />
											
										<!-- pass a session id to the query string of the script to prevent ie caching -->
										<a tabindex="-1" style="border-style: none" title="Refresh Image" href="#" onClick="document.getElementById('siimage').src = '../includes/captcha/securimage_show.php?sid=' + Math.random(); return false">
										<img src="../includes/captcha/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
									</div>
								</td>
							</tr>
							<tr>
								<td>Kode</td>
								<td>:</td>
								<td><input type="text" id="txtkode" onkeyup="javascript: if(event.keyCode==13){ if(this.value=='') alert('User kode dulu donk !!!'); else sendRequest('login_proses.php', 'proc=login&user='+document.getElementById('txtuser').value+'&pass='+document.getElementById('txtpass').value+'&kode='+document.getElementById('txtkode').value, 'login', 'div', '../images/loader.gif'); }" /></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><input type="button" value="Enter" style="background-color:#efe7fa;" onclick="javascript: sendRequest('login_proses.php', 'proc=login&user='+document.getElementById('txtuser').value+'&pass='+document.getElementById('txtpass').value+'&kode='+document.getElementById('txtkode').value, 'login', 'div', '../images/loader.gif'); " /></td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
		<div id="footer-login">
			Copyright &copy; <?php echo date("Y"); ?> <a ondblclick="javascript: window.location.href='administrator/index.php';"><?php echo $footer; ?></a>
		</div>
	</body>
	<!-- End of halaman login -->
	<?php
		unset($_SESSION['s_stAdmin']);
	}else{
		if(!isset($_SESSION['s_adminPage'])) $page = "welcome.php";
		else $page = $_SESSION['s_adminPage'];
	?>
	<!-- Halaman Admin -->
	<body onload="javascript: sendRequest('<?php echo $page; ?>', '', 'content', 'div', '../images/loader.gif');">
		<div id="header">
			<div id="header-left">
				<img src="../images/home.png" />
				<h2 style="cursor:pointer;" onclick="javascript: window.open('../index.php', '_blank'); sendRequest('welcome.php', '', 'content', 'div', '');"><?php echo _header_; ?></h2>
			</div>
			<div id="header-right">
				<div id="usericon"><img src="../images/admin.png" width="20" height="20" /></div>
				<div id="userlogin"><?php echo @$_SESSION['s_namaAdmin']; echo ", "; ?></div>
				<div id="logout"><img src="../images/exit.png" /><a onclick="javascript: if(confirm('Keluar?')) sendRequest('logout.php', '', 'content', 'div', '../images/loader.gif');">Keluar</a></div>
			</div>
		</div>
		<div id="menu"><?php include "menu.php"; ?></div>
		<div id="content" onmouseover="javascript: $('#message').fadeOut(3000);"></div>
		<div id="footer">
			<span id="footer-left"><?php echo _footer_left_; ?> &copy; 2012</span>
			<span id="footer-right">Administrator of <?php echo _footer_right_; ?></span>
		</div>
	</body>
	<!-- End of halaman admin -->
	<?php
	}
	?>
</html>