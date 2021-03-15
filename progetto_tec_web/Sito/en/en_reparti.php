<?php
include '../db_pwd.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it"> 
	<head>
		<title>CPF Meccanica</title>
		
		<!-- Info -->
		<meta name="title" content="CPF Meccanica"/> 
		<meta name="description" content="CPF Meccanica Company" />
		<meta name="keywords" content="Meccanica, Commerce" />
		<meta name="language" content="EN" /> 
		<meta name="author" content="Benetazzo, De Grandi, Guzzo, Zenere" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<!-- Desktop -->
		<link rel="stylesheet" type="text/css" href="../css/base_normal.css"/>
		<link rel="stylesheet" type="text/css" href="../css/reparti_normal.css"/>
		
		<!-- Mobile -->
		<link rel="stylesheet" type="text/css" href="../css/base_small.css" media="handheld, screen and (max-width: 600px)"/>
		<link rel="stylesheet" type="text/css" href="../css/reparti_small.css" media="handheld, screen and (max-width: 600px)"/>
		
		<!-- Print -->
		<link rel="stylesheet" type="text/css" href="../css/base_print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="../css/reparti_print.css" media="print" />
		
		<!-- Favicon -->
		<link rel="icon" href="../img/logo.gif" type="image/gif" />
		
		<!-- Javascript -->
		<script src="../js/offcanvas.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="header">
			<a href="en_home.php"><img src="../img/logo.png" id="logo" alt=""/></a>
			<h1>Men at work... for real!</h1>
			<a href="../it/it_reparti.php" id="lingua">EN<img src="../img/world.png" alt="" id="mondo"/></a>
			<img src="../img/menu.png" id="menu" alt="" onclick="openNav()"/>
			<h2 id="print-title">CPF Meccanica</h2>
		</div>
		<div id="nav">
			<a href="javascript:void(0)" id="closenav" onclick="closeNav()">&times;</a>
			<ul>
				<li><a href="en_home.php">Home</a></li>
				<li><a href="en_chi.html">Who we are</a></li>
				<li class="currentLink"><a href="en_reparti.php" class="currentLink">Department</a></li>
				<li><a href="en_catalogo.php">Catalog</a></li>
				<li><a href="en_contattaci.php">Contact Us</a></li>
				<li><a href="en_login.php">Login</a></li>
			</ul>
		</div>
		
		<div id="breadcrumbs">
			<?php
			if(isset($_GET["rep"])){
				echo "<p>You're on: <a href=\"en_reparti.php\">Department</a> -> <a href=\"en_reparti.php?art=".$_GET["rep"]."\">n°".$_GET["rep"]."</a></p>";
			}else{
				echo "<p>You're on: <a href=\"en_reparti.php\">Department</a></p>";
			}
			?>
		</div>
		<div id="contenuto">
		
		</div>
		<div id="footer">
			<img src="../img/logo2.png" id="logo_footer" alt=""/>
			<p>&copy; C.P.F. All Rights Reserved.</p>
		</div>
	</body>
</html>
