<?php
session_start();
include '../db_pwd.php';

function correttore($str){
	$ris = nl2br($_POST["message"]);
	$ris = str_replace("'", "\'", $ris);
	$ris = str_replace ("à", "&agrave;", $ris);
	$ris = str_replace ("è", "&egrave;", $ris);
	$ris = str_replace ("ì", "&igrave;", $ris);
	$ris = str_replace ("ò", "&ograve;", $ris);
	$ris = str_replace ("ù", "&ugrave;", $ris);
	return $ris;
}

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
		<link rel="stylesheet" type="text/css" href="../css/home_normal.css"/>
		
		<!-- Mobile -->
		<link rel="stylesheet" type="text/css" href="../css/base_small.css" media="handheld, screen and (max-width: 600px)"/>
		<link rel="stylesheet" type="text/css" href="../css/home_small.css" media="handheld, screen and (max-width: 600px)"/>
		
		<!-- Print -->
		<link rel="stylesheet" type="text/css" href="../css/base_print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="../css/home_print.css" media="print" />
		
		<!-- Favicon -->
		<link rel="icon" href="../img/logo.gif" type="image/gif" />
		
		<!-- Javascript -->
		<script src="../js/offcanvas.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/it_ctrl_form_home.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="header">
			<a href="it_home.php"><img src="../img/logo.png" id="logo" alt=""/></a>
			<h1 xml:lang="en">Men at work... for real!</h1>
			<a href="../en/en_home.php" id="lingua">IT<img src="../img/world.png" alt="" id="mondo"/></a>
			<img src="../img/menu.png" id="menu" alt="" onclick="openNav()"/>
			<h2 id="print-title">CPF Meccanica</h2>
		</div>
		<div id="nav">
			<a href="javascript:void(0)" id="closenav" onclick="closeNav()">&times;</a>
			<ul>
				<li xml:lang="en" class="currentLink"><a href="it_home.php" class="currentLink">Home</a></li>
				<li><a href="it_chi.html">Chi siamo</a></li>
				<li><a href="it_reparti.php">Reparti</a></li>
				<li><a href="it_catalogo.php">Catalogo</a></li>
				<li><a href="it_contattaci.php">Contattaci</a></li>
				<li><a href="it_login.php">Accesso</a></li>
			</ul>
		</div>
		<div id="breadcrumbs">
			<?php
			if(isset($_GET["art"])){
				echo "<p>Sei su: <a href=\"it_home.php\">Home</a> -> <a href=\"it_home.php?art=".$_GET["art"]."\">Articolo n°".$_GET["art"]."</a></p>";
			}else{
				echo "<p>Sei su: <a href=\"it_home.php\">Home</a></p>";
			}
			?>
		</div>
		<div id="contenuto">
			<?php								
				$con = mysqli_connect($host, $username, $password, $db_name) or header('Location: it_503.php');
			
				if(isset($_GET["art"])){
					
					if(isset($_POST["addcommento"])){
						$commento = $_POST["txtcommento"];
						if($commento == ""){
							echo "<script>alert(\"Errore: non hai scritto niente.\");</script>";
						}else{
							$sql = "INSERT INTO `commenti` (`id`, `articolo`, `username`, `commento`, `mipiace`) VALUES (NULL, '".$_GET["art"]."', '".$_SESSION["username"]."', '".$commento."', 0);";
							mysqli_query($con, $sql);
						}
					}
					
					if(isset($_POST["addlike"])){
						
						$sql = "UPDATE commenti SET mipiace=".$_POST['mipiace']." WHERE id=".$_POST['idcomment'].";";
						mysqli_query($con, $sql);
					}
					
					$sql = "SELECT * FROM `news` WHERE id=".$_GET["art"];
					$result = mysqli_query($con, $sql);
					
					if(mysqli_affected_rows($con) == 1){
						$row = mysqli_fetch_array($result);
						echo "<div id=\"art\">";
						echo "<p class=\"title\">".$row['titolo']."</p>";
						echo "<p class=\"text\">".$row['testo']."</p>";
						echo "</div>";
						
						$sql = "SELECT c.id AS id, u.username AS user, u.nome AS nome, c.commento AS commento, c.mipiace AS mipiace FROM users AS u JOIN commenti AS c ON u.username = c.username WHERE c.articolo =".$_GET["art"];
						$result = mysqli_query($con, $sql);
						
						echo "<div class=\"div_commento\">";
						echo "<p class=\"tit_commento\">Commenti</p>";
						if(mysqli_affected_rows($con) == 0){
							echo "<div class=\"commento\">";
							echo "<p id=\"nocomment\">Non sono stati trovati commenti.</p>";
							echo "</form>";
							echo "</div>";
						}else{
							$token = false;
							while($row = mysqli_fetch_array($result)){
								$idcomment = $row['id'];
								$user = $row['user'];
								$nome = $row['nome'];
								$commento = $row['commento'];
								$mipiace = $row['mipiace'];
								
								if($token == true){
									echo "<hr class=\"hrcommento\"/>";
								}
								$token = true;
								echo "<div class=\"commento\">";
								echo "<p><strong>".$nome."</strong> - ".$commento."</p>";
								echo "<form action=\"\" method=\"post\">";
								echo "<p><input type=\"submit\" name=\"addlike\" value=\"".$mipiace." mi piace\" class=\"likes\"/></p>";
								echo "<p><input type='hidden' class=\"novisible\" name='user' value='".$user."'/></p>";
								echo "<p><input type='hidden' class=\"novisible\" name='idcomment' value='".$idcomment."'/></p>";
								echo "<p><input type='hidden' class=\"novisible\" name='mipiace' value='".($mipiace+1)."'/></p>";
								echo "</form>";
								echo "</div>";
							}
						}
						if(isset($_SESSION["username"])){
							echo "<hr/ class=\"hrcommento\">";
							echo "<form action=\"\" onsubmit=\"return controlla_commento();\" method=\"post\">";
							echo "<p id=\"infocommento\">Hei ".$_SESSION['nome'].", lasciaci un commento</p>";
							echo "<input type=\"text\" name=\"txtcommento\" id=\"txtcommento\" class=\"input\" id=\"txtcommento\"/>";
							echo "<p><input type=\"submit\" name=\"addcommento\" value=\"Scrivi\" class=\"button\"/></p>";
							echo "</form>";
						}
						echo "</div>";
						
					}else{
						echo "<script>alert(\"Nessun articolo trovato.\");</script>";
					}
									
				}else{
					
					echo "<div id=\"welcome\"><h3>Benvenuti in CPF Meccanica</h3></div>";
					
					echo "<img src=\"../img/sede.jpg\" id=\"imgsede\" alt=\"\" />";
				
					echo "<p id=\"ln\">Ultime News:</p>";					
					
					if(isset($_POST["aggiungi"])){
						$titolo = $_POST["aggTitolo"];
						$txt = correttore($_POST["message"]);
						if($titolo == "" or $txt == ""){
							echo "<script>alert(\"Errore: non hai scritto niente.\");</script>";
						}else{
							$sql = "INSERT INTO `news` (`id`, `titolo`, `testo`) VALUES (NULL, '".$titolo."', '".$txt."');";
							mysqli_query($con, $sql);
						}
					}
					if(isset($_POST["rimuovi"])){
						$sql = "DELETE FROM `news` WHERE `titolo`=\"".$_POST["rmTitolo"]."\"";
						mysqli_query($con, $sql);
						
						echo "<script>alert(\"Rimossi ".mysqli_affected_rows($con)." elementi.\");</script>";
					}
				
					$sql = "SELECT * FROM `news`";
					$result = mysqli_query($con, $sql);
					
					$float = "sx";
					while($row = mysqli_fetch_array($result)){
						$id =$row['id'];
						$titolo =$row['titolo'];
						$testo =$row['testo'];
						
						echo "<div class=\"".$float."\" onclick=\"location.href='it_home.php?art=".$id."'\">";
						echo "<p class=\"title\">".$titolo."</p>";
						echo "<p class=\"vedialtro\"><a href=\"it_home.php?art=".$id."\" class=\"text\">Vedi altro...</a></p>";
						echo "<p class=\"text\">".$testo."</p>";
						echo "</div>";
						
						if($float == "sx"){
							$float = "dx";
						}else{
							$float = "sx";
						}
					}
					
					if($_SESSION["username"] == "admin"){
				?>
				<div id="admin">
					<br/><br/><hr class="hrnormal"/>
					<h3>Pannello Amministratore</h3>
					<form class="form" action="" onsubmit="return controlla_inserisci();" method="post">
						<fieldset>
							<legend>Aggiungi Articolo</legend>
							<p>
								<label for="name">Titolo:</label><br/>
								<input type="text" name="aggTitolo" id="aggTitolo" class="input" size="40" />
							</p>
							<p>
								<label for="message-text">Testo:</label><br/>
								<textarea name="message" id="message" class="input" rows="10" cols="60"></textarea>
							</p>
							<p>
								<input type="submit" name="aggiungi" value="Crea" class="button" />
							</p>
						</fieldset>
					</form>
					<form class="form" action="" onsubmit="return controlla_rimuovi();" method="post">
						<fieldset>
							<legend>Rimuovi Articolo</legend>
							<p>
								<label for="name">Titolo:</label><br/>
								<select name="rmTitolo" id="rmTitolo" class="input">
									<?php
										$sql = "SELECT * FROM `news`";
										$result = mysqli_query($con, $sql);
										
										while($row = mysqli_fetch_array($result)){											
											echo "<option>".$row['titolo']."</option>";
										}
									?>
								</select>
							</p>
							<p>
								<input type="submit" name="rimuovi" value="Rimuovi" class="button" />
							</p>
						</fieldset>
					</form>
				</div>
				<?php
					}
				}
				mysqli_close();
				?>
		</div>
		<div id="footer">
			<img src="../img/logo2.png" id="logo_footer" alt=""/>
			<p xml:lang="en">&copy; C.P.F. All Rights Reserved.</p>
		</div>
	</body>
</html>
