<?php
session_start();
include '../db_pwd.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it"> 
	<head>
		<title>CPF - Login</title>
		
		<!-- Info -->
		<meta name="title" content="CPF - Login"/> 
		<meta name="description" content="CPF Meccanica Company" />
		<meta name="keywords" content="Meccanica, Commerce" />
		<meta name="language" content="EN" /> 
		<meta name="author" content="Benetazzo, De Grandi, Guzzo, Zenere" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<!-- Desktop -->
		<link rel="stylesheet" type="text/css" href="../css/base_normal.css"/>
		<link rel="stylesheet" type="text/css" href="../css/login_normal.css"/>
		
		<!-- Mobile -->
		<link rel="stylesheet" type="text/css" href="../css/base_small.css" media="handheld, screen and (max-width: 600px)"/>
		<link rel="stylesheet" type="text/css" href="../css/login_small.css" media="handheld, screen and (max-width: 600px)"/>
		
		<!-- Print -->
		<link rel="stylesheet" type="text/css" href="../css/base_print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="../css/login_print.css" media="print" />
		
		<!-- Favicon -->
		<link rel="icon" href="../img/logo.gif" type="image/gif" />
		
		<!-- Javascript -->
		<script src="../js/offcanvas.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/en_ctrl_form_home.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="header">
			<a href="en_home.php"><img src="../img/logo.png" id="logo" alt=""/></a>
			<h1>Men at work... for real!</h1>
			<a href="../it/it_login.php" id="lingua">EN<img src="../img/world.png" alt="" id="mondo"/></a>
			<img src="../img/menu.png" id="menu" alt="" onclick="openNav()"/>
			<h2 id="print-title">CPF Meccanica</h2>
		</div>
		<div id="nav">
			<a href="javascript:void(0)" id="closenav" onclick="closeNav()">&times;</a>
			<ul>
				<li><a href="en_home.php">Home</a></li>
				<li><a href="en_chi.html">Who we are</a></li>
				<li><a href="en_reparti.php">Department</a></li>
				<li><a href="en_catalogo.php">Catalog</a></li>
				<li><a href="en_contattaci.php">Contact Us</a></li>
				<li class="currentLink"><a class="currentLink" href="en_login.php">Login</a></li>
			</ul>
		</div>
		<div id="breadcrumbs">
			<p>You're on: <a href="en_login.php">Login</a></p>
		</div>
		<div id="contenuto">
		<?php
		
			//Metodo per effettuare il logout
			if(isset($_POST["logout"])){
				$_SESSION=array();
				header("location:./en_login.php");
			}
			
			//Verifica se esiste (nel database) un utente corrispondente alla richiesta di login
			if(isset($_POST["login"])){
				
				$con = mysqli_connect($host, $username, $password, $db_name) or header('location: en_503.php');
			
				$sql = "SELECT * FROM `users`";
				$result = mysqli_query($con, $sql);
				
				while($row = mysqli_fetch_array($result)){
					$username =$row['username'];
					$nome =$row['nome'];
					$password =$row['password'];
					
					if($username == $_POST["user"]){
						if($password == sha1($_POST["pwd"])){
							$_SESSION['username'] = $username;
							$_SESSION['nome'] = $nome;
						}
					}
				}				
				mysqli_close();
			}
			
			if(isset($_POST["reg"])){
				if($_POST["user"] == "" or $_POST["nome"] == "" or $_POST["pwd"] == ""){
					echo "<script>alert(\"Error: you left some empty field.\");</script>";
				}else{
					$con = mysqli_connect($host, $username, $password, $db_name) or die('Unable to connect to server');
					$sql = "INSERT INTO `users` (`username`, `nome`, `password`) VALUES ('".$_POST["user"]."', '".$_POST["nome"]."', '".sha1($_POST["pwd"])."')";
					mysqli_query($con, $sql);
					if(mysqli_error($con) == true){
						echo "<script>alert(\"Warning! Username ".$_POST["user"]." already used.\");</script>";
					}
					mysqli_close();
				}
			}
			
			//Creazione del menù laterale a seconda se ci si è loggati
			if(isset($_SESSION['username'])==false){
		?>
				<form class="form" action="en_login.php" method="post">
					<fieldset>
						<legend>Login</legend>
						<div class="spaced">
							<label>Username:</label><br/>
							<input type="text" name="user" class="input" size="40" />
						</div>
						<div class="spaced">
							<label>Password:</label><br/>
							<input type="password" name="pwd" class="input" size="40" />
						</div>
						<div class="spaced">
							<input type="submit" name="login" value="Login" class="button" />
						</div>
					</fieldset>
				</form>
				<div id="div_btn_reg"><button id="registrati" onclick="document.getElementById('reg').style = 'display: inline;'">Sign in</button></div>
				<form class="form" action="en_login.php" method="post" onsubmit="return controlla_newUser();" id="reg">
					<fieldset>
						<legend>Sign in</legend>
						<div class="spaced">
							<label>Nome:</label><br/>
							<input type="text" name="nome" id="regNome" class="input" size="40" />
						</div>
						<div class="spaced">
							<label>Username:</label><br/>
							<input type="text" name="user" id="regUser" class="input" size="40" />
						</div>
						<div class="spaced">
							<label>Password:</label><br/>
							<input type="password" name="pwd" id="regPwd" class="input" size="40" />
						</div>
						<div class="spaced">
							<input type="submit" name="reg" value="Sign in" class="button" />
						</div>
					</fieldset>
				</form>
		<?php
			}else{
		?>
				<form class="form" action="en_login.php" method="post">
					<fieldset>
						<p class="spaced">
							<label for="message-text"><?php echo "Welcome ".$_SESSION['nome']; ?></label><br/>
							<input type="submit" name="logout" value="Logout" class="button" />
						</p>
					</fieldset>
				</form>
		<?php
			}
		?>
		</div>
		<div id="footer">
			<img src="../img/logo2.png" id="logo_footer" alt=""/>
			<p>&copy; C.P.F. All Rights Reserved.</p>
		</div>
		<?php
			if(isset($_POST["login"])){
				if(isset($_SESSION['username'])==false){
					echo "<script>alert(\"Warning! Wrong user or password.\");</script>";
				}
			}
		?>
	</body>
</html>
