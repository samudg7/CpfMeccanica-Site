<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it"> 
	<head>
		<title>CPF - Catalogo</title>
		
		<!-- Info -->
		<meta name="title" content="CPF Meccanica"/> 
		<meta name="description" content="Azienda CPF Meccanica" />
		<meta name="keywords" content="Meccanica, Commerce" />
		<meta name="language" content="IT" /> 
		<meta name="author" content="Benetazzo, De Grandi, Guzzo, Zenere" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<!-- Desktop -->
		<link rel="stylesheet" type="text/css" href="../css/base_normal.css" media="handheld, screen and (min-width: 600px)"/>
		<link rel="stylesheet" type="text/css" href="../css/catalogo_normal.css" media="handheld, screen and (min-width: 600px)"/>
		
		<!-- Mobile -->
		<link rel="stylesheet" type="text/css" href="../css/base_small.css" media="handheld, screen and (max-width: 600px)"/>
		<link rel="stylesheet" type="text/css" href="../css/catalogo_small.css" media="handheld, screen and (max-width: 600px)"/>
		
		<!-- Print -->
		<link rel="stylesheet" type="text/css" href="../css/base_print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="../css/catalogo_print.css" media="print" />
		
		<!-- Favicon -->
		<link rel="icon" href="../img/logo.gif" type="image/gif" />
		
		<!-- Javascript -->
		<script src="../js/offcanvas.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="header">
			<a href="it_home.php"><img src="../img/logo.png" id="logo" alt=""/></a>
			<h1 xml:lang="en">Men at work... for real!</h1>
			<a href="../en/en_catalogo.php" id="lingua">IT<img src="../img/world.png" alt="" id="mondo"/></a>
			<img src="../img/menu.png" id="menu" alt="" onclick="openNav()"/>
			<h2 id="print-title">CPF Meccanica</h2>
		</div>
		<div id="nav">
			<a href="javascript:void(0)" id="closenav" onclick="closeNav()">&times;</a>
			<ul>
				<li xml:lang="en"><a href="it_home.php">Home</a></li>
				<li><a href="it_chi.html">Chi siamo</a></li>
				<li><a href="it_reparti.php">Reparti</a></li>
				<li class="currentLink"><a href="it_catalogo.php" class="currentLink">Catalogo</a></li>
				<li><a href="it_contattaci.php">Contattaci</a></li>
				<li id="login"><a href="it_login.php">Accesso</a></li>
			</ul>
		</div>
		<div id="breadcrumbs">
			<?php
			if(isset($_GET["cat"])){
				echo "<p>Sei su: <a href=\"it_catalogo.php\">Catalogo</a> -> <a href=\"it_catalogo.php?cat=".$_GET["cat"]."\">Articolo n°".$_GET["cat"]."</a></p>";
			}else{
				echo "<p>Sei su: <a href=\"it_catalogo.php\">Catalogo</a></p>";
			}
			?>
		</div>
		<div id="contenuto">
			<div id="titolo_pagina"><h3>Catalogo Prodotti</h3></div>
				
				<div id="prodotti">
					
				<?php
					session_start();
				
					include '../db_pwd.php';
					
					$con=mysqli_connect($host, $username,$password, $db_name) or die('Impossibile connettersi al server');
					
					if(isset($_POST["aggiungi"])){
						$errore = false;
						$nomeP = $_POST['aggNome'];
						$materiale = $_POST['aggMateriale'];
						$peso = $_POST['aggPeso'];
						$prezzo = $_POST['aggPrezzo'];
						$descrizione = $_POST['aggDescrizione'];
						
						if($_POST['aggNome'] == ""){
							echo "<script>alert(\"Attenzione: Non hai inserito il nome del prodotto.\");</script>";
							$errore = true;
						}
						if($errore ==false && $_POST['aggMateriale'] == ""){
							echo "<script>alert(\"Attenzione: Non hai inserito il materiale del prodotto.\");</script>";
							$errore = true;
						}
						if($errore ==false && !preg_match('/^[0-9\.]+$/', $_POST['aggPeso'])){
							echo "<script>alert(\"Attenzione: Hai inserito il peso in un formato errato: sono ammessi solo numeri e punti (non virgole)\");</script>";
							$errore = true;
						}
						if($errore ==false && !preg_match('/^[0-9\.]+$/', $_POST['aggPrezzo'])){
							echo "<script>alert(\"Attenzione: Hai inserito il prezzo in un formato errato: sono ammessi solo numeri e punti (non virgole)\");</script>";
							$errore = true;
						}
						if($errore ==false && $_POST['aggDescrizione'] == ""){
							echo "<script>alert(\"Attenzione: Non hai inserito una descrizione del prodotto.\");</script>";
							$errore = true;
						}
						if($errore == false){
							$result = false;
							$immagine = '';
							$size = 0;
							$type = '';
							$nome = '';
							$max_size = 300000;
							$result = @is_uploaded_file($_FILES['file']['tmp_name']);
							if (!$result){
								echo "<script>alert(\"Impossibile eseguire l'upload.\");</script>";
							}else{
								$size = $_FILES['file']['size'];
								if ($size > $max_size){
									echo "<script>alert(\"Il file è troppo grande.\");</script>";
								}
								$type = $_FILES['file']['type'];
								$nome = $_FILES['file']['name'];
								$immagine = @file_get_contents($_FILES['file']['tmp_name']);
								$immagine = addslashes ($immagine);
								$sql = "INSERT INTO `catalogo` (`id`, `nome`, `materiale`, `peso`, `prezzo`, `descrizione`, `immagine`) VALUES (NULL, '".$nomeP."', '".$materiale."', '".$peso."', '".$prezzo."', '".$descrizione."', '".$immagine."');";
								mysqli_query($con, $sql);
							}
						}
					}
					
					
					if(isset($_POST["rimuovi"])){
						$sql = "DELETE FROM `catalogo` WHERE `nome`=\"".$_POST["rmProdotto"]."\"";
						mysqli_query($con, $sql);
						
						echo "<script>alert(\"Rimossi ".mysqli_affected_rows($con)." elementi.\");</script>";
					}	
					
					
					//carica singolo
						$sql = "SELECT * FROM `catalogo` WHERE `id`=".$_GET["cat"];
						$result=mysqli_query($con, $sql);
					if(mysqli_affected_rows($con)==1){
						$row=mysqli_fetch_array($result);
							echo '<img src="data:image/jpeg;base64,'.base64_encode($row['immagine']).'" alt=""/>';						
							echo "<p class=\"nome\">".$row['nome']."</p>";
							echo "<p>"."Materiale: ".$row['materiale']."</p>";
							echo "<p>"."Peso: ".$row['peso']." KG"."</p>";
							echo "<p>"."Prezzo: ".$row['prezzo']." euro"."</p>";
							echo "<p>".$row['descrizione']."</p>";
					}
						
					
					else
					{
							$sql = "SELECT * FROM `catalogo`;";
							$result=mysqli_query($con,$sql);
							while($row=mysqli_fetch_array($result)){
								$id=$row['id'];
								$url="it_catalogo.php?cat=".$id;
								echo "<div class=\"img\">".'<img src="data:image/jpeg;base64,'.base64_encode($row['immagine']).'" alt=""/>'."</div>";
								echo "<p class=\"nomecatalogo\">".$row['nome']."</p>";
								echo "<div class=\"desc\">"."<p>"."Materiale: ".$row['materiale']."</p>"."<p>".$row['prezzo']." euro"."</p>"."</div>";
								echo "<div class=\"info\">".'<a href="'.$url.'">+ info</a>'."</div>";
								
							}									
					}
					
					if($_SESSION["username"] == "admin"){
				?>
				</div>		
			<div id="admin">
					<br/><br/><hr class="hrnormal"/>
					<h3>Pannello Amministratore</h3>
					<form id="form" enctype="multipart/form-data" action="" method="post">
						<fieldset>
							<legend>Aggiungi Prodotto</legend>
							<p>
								<label for="name">Nome:</label><br/>
								<input type="text" name="aggNome" class="input" size="40" />
							</p>
							<p>
								<label for="materiale">Materiale:</label><br/>
								<textarea type="text" name="aggMateriale" class="input" size="60"></textarea>
							</p>
							<p>
								<label for="peso">Peso(KG):</label><br/>
								<textarea type="text" name="aggPeso" class="input" size="10"></textarea>
							</p>
							<p>
								<label for="prezzo">Prezzo(Euro):</label><br/>
								<textarea type="text" name="aggPrezzo" class="input" size="10"></textarea>
							</p>
							<p>
								<label for="descrizione">Descrizione:</label><br/>
								<textarea type="text" name="aggDescrizione" class="input" rows="10" cols="60"></textarea>
							</p>
							<p>
								<label for="immagine">Immagine:</label><br/>
								<input type="file" name="file" class="input"></input>
							</p>
							<p>
								<input type="submit" name="aggiungi" value="Inserisci" class="button" />
							</p>
						</fieldset>
					</form>
					<form id="form" action="" method="post">
						<fieldset>
							<legend>Rimuovi Prodotto</legend>
							<p>
								<label for="name">Nome:</label><br/>
								<select name="rmProdotto" id="rmProdotto" class="input">
									<?php
										$sql = "SELECT * FROM `catalogo`";
										$result = mysqli_query($con, $sql);
										
										while($row = mysqli_fetch_array($result)){											
											echo "<option>".$row['nome']."</option>";
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
				mysqli_close();
				?>
			</div>
		</div>
		<div id="footer">
			<img src="../img/logo2.png" id="logo_footer" alt=""/>
			<p xml:lang="en">&copy; C.P.F. All Rights Reserved.</p>
		</div>
	</body>
</html>
