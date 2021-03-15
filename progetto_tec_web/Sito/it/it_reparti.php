<?php
include '../db_pwd.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it"> 
	<head>
		<title>CPF Meccanica</title>
		
		<!-- Info -->
		<meta name="title" content="CPF Meccanica"/> 
		<meta name="description" content="Azienda CPF Meccanica" />
		<meta name="keywords" content="Meccanica, Commerce" />
		<meta name="language" content="IT" /> 
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
			<a href="it_home.php"><img src="../img/logo.png" id="logo" alt=""/></a>
			<h1 xml:lang="en">Men at work... for real!</h1>
			<a href="../en/en_reparti.php" id="lingua">IT<img src="../img/world.png" alt="" id="mondo"/></a>
			<img src="../img/menu.png" id="menu" alt="" onclick="openNav()"/>
			<h2 id="print-title">CPF Meccanica</h2>
		</div>
		<div id="nav">
			<a href="javascript:void(0)" id="closenav" onclick="closeNav()">&times;</a>
			<ul>
				<li xml:lang="en"><a href="it_home.php">Home</a></li>
				<li><a href="it_chi.html">Chi siamo</a></li>
				<li class="currentLink"><a href="it_reparti.php" class="currentLink">Reparti</a></li>
				<li><a href="it_catalogo.php">Catalogo</a></li>
				<li><a href="it_contattaci.php">Contattaci</a></li>
				<li id="login"><a href="it_login.php">Accesso</a></li>
			</ul>
		</div>
		
		<div id="breadcrumbs">
			<?php
			if(isset($_GET["rep"])){
				echo "<p>Sei su: <a href=\"it_reparti.php\">Reparti</a> -> <a href=\"it_reparti.php?art=".$_GET["rep"]."\">Reparto ".$_GET["rep"]."</a></p>";
			}else{
				echo "<p>Sei su: <a href=\"it_reparti.php\">Reparti</a></p>";
			}
			?>
		</div>
		<div id="contenuto">
		
			<?php
				$con = mysqli_connect($host, $username, $password, $db_name) or header('Location: it_503.php');
			
			
				if(isset($_GET["rep"])){
					$sql = "SELECT * FROM `reparti` WHERE id=".$_GET["rep"];
					$result = mysqli_query($con, $sql);
					
					if(mysqli_affected_rows($con) == 1){
						$row = mysqli_fetch_array($result);
						echo "<div id=\"art\">";
						echo "<p class=\"nome\">".$row['nome']."</p>";
						
						echo '<img alt="" class="imginterna" src="data:image/jpeg;base64,'.base64_encode($row['immagine']).'"/>';
						echo "<p class=\"descrizione\">".$row['descrizione']."</p>";
						echo "</div>";
					}
					
				}else{
					echo "<div id=\"welcome\"><h3>Reparti</h3></div>";
					
					$sql = "SELECT * FROM `reparti`";
					$result = mysqli_query($con, $sql);
					
					$float = "sx";
					echo "<ul class=\"capitalize\">";
					while($row = mysqli_fetch_array($result)){
						$id =$row['id'];
						$nome =$row['nome'];
						$descrizione =$row['descrizione'];
						
						echo "<li class=\"".$float."\" onclick=\"location.href='it_reparti.php?rep=".$id."'\">";
						echo "<p><a href=\"it_reparti.php?rep=".$id."\">".$nome."</a></p>";
						echo '<img class="img" alt="Approfondisci" src="data:image/jpeg;base64,'.base64_encode($row['immagine']).'"/></li>';
						
						
						if($float == "sx"){
							$float = "dx";
						}else{
							$float = "sx";
						}
					}
					echo "</ul>";
				}
			
			?>
		</div>
		<div id="footer">
			<img src="../img/logo2.png" id="logo_footer" alt=""/>
			<p xml:lang="en">&copy; C.P.F. All Rights Reserved.</p>
		</div>
	</body>
</html>
