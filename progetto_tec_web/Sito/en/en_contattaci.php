<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it"> 
	<head>
		<title>CPF - Contattaci</title>
		
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
		<link rel="stylesheet" type="text/css" href="../css/contattaci_normal.css"/>
		
		<!-- Mobile -->
		<link rel="stylesheet" type="text/css" href="../css/base_small.css" media="handheld, screen and (max-width: 600px)"/>
		<link rel="stylesheet" type="text/css" href="../css/contattaci_small.css" media="handheld, screen and (max-width: 600px)"/>
		
		<!-- Print -->
		<link rel="stylesheet" type="text/css" href="../css/base_print.css" media="print"/>
		<link rel="stylesheet" type="text/css" href="../css/contattaci_print.css" media="print"/>
		
		<!-- Favicon -->
		<link rel="icon" href="../img/logo.gif" type="image/gif" />
		
		<!-- Javascript -->
		<script src="../js/offcanvas.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/form_contattaci.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="header">
			<a href="en_home.php"><img src="../img/logo.png" id="logo" alt=""/></a>
			<h1>Men at work... for real!</h1>
			<a href="../it/it_contattaci.php" id="lingua">EN<img src="../img/world.png" alt="" id="mondo"/></a>
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
				<li class="currentLink"><a class="currentLink" href="en_contattaci.php">Contact Us</a></li>
				<li><a href="en_login.php">Login</a></li>
			</ul>
		</div>
		<div id="breadcrumbs">
			<p>You're on: <a href="en_contattaci.php">Contact Us</a></p>
		</div>
		<div id="contenuto">
			<div id="contatto">
				<h3>Office</h3>
				<p>via Vicenza 244/246,</p>
				<p>Altavia Vicentina,</p>
				<p>VI,</p>
				<p>Italy</p>
				<p>Phone: +39 0444 341806</p>
				<p>Fax: +39 0444 277105</p>
				<p>E-Mail: <a href="mailto:info@cpfmeccanica.com">info@cpfmeccanica.com</a></p>
			</div>
			<img src="../img/maps.png" id="maps" alt="" onclick="window.open(this.src)" />
			<hr/>
			<form id="form" action="en_contattaci.php" onsubmit="return validazioneForm()" method="post">
			<p>Leave us a message:</p>
				<p>
					<label for="name">Name:</label><br/>
					<input type="text" name="first_name" id="name" class="input" size="40" />
				</p>
				<p>
					<label for="email" xml:lang="en">E-mail:</label><br/>
					<input type="text" name="email" id="email" class="input" size="40" />
				</p>
				<p>
					<label for="message_text">Message:</label><br/>
					<textarea name="message" id="message_text" class="input" rows="10" cols="60"></textarea>
				</p>
				<p>
					<input type="submit" name="info" value="Request information" id="invio" />
				</p>
			</form>
			<hr/>
			<div id="credit">
				<h5>Educational project of the course Web technologies produced by:</h5>
				<p>Gianmarco Guzzo - 1000000</p>
				<p>Marco Zenere - 1000000</p>
				<p>Samuele Grandi - 1000000</p>
				<p>Luca Benetazzo - 1122109</p><br/>
				<img src="../img/vhtml.png" alt="Valid XHTML 1.0 Strict" />
				<img src="../img/vcss.gif" alt="Valid CSS 1.0 Strict" />
			</div>
		</div>
		<div id="footer">
			<img src="../img/logo2.png" id="logo_footer" alt=""/>
			<p>&copy; C.P.F. All Rights Reserved.</p>
		</div>
		<?php
			if(isset($_POST['info'])){
				
				if(preg_match('/^[a-zA-Z0-9\s]{3,25}$/', $_POST['first_name'])){
					if(preg_match('/\w+@\w+\.\w{2,4}/', $_POST['email'])){
						$subject = "Information request CPF Meccanica";
						$subject2 = "Copy of Information request CPF Meccanica";
						$message = "Message by: " . $_POST['nome'] . "\n\n" . $_POST['message_text'];
						$message2 = "Copy of the message sent to CPF Meccanica" . "\n\n" . $_POST['message_text'];
						$headers = "From:" . $_POST['email'];
						$headers2 = "From: mail@mail.it";
						//mail($to,$subject,$message,$headers); 		*** FUNZIONE MAIL DISATTIVATA ***
						//mail($from,$subject2,$message2,$headers2);	*** FUNZIONE MAIL DISATTIVATA ***
						echo "<script>alert(\"Message sent correctly.\");</script>";
					}else{
						echo "<script>alert(\"Wrong mail: maybe you were wrong to type, check\");</script>";
					}
				}else{
					echo "<script>alert(\"Wrong name: must contain at least 3 characters\");</script>";
				}
			}
		?>
	</body>
</html>
