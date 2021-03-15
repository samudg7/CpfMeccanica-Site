<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it"> 
	<head>
		<title>CPF Meccanica</title>
		
	</head>
	<body>
		
			<?php
				$host = "localhost";
				$username = "lbenetaz";
				$password = "cheigei2hox6ahHo";
				$db_name = "lbenetaz";
				
				$con = mysqli_connect($host, $username, $password, $db_name) or die('Impossibile connettersi al server');
			
				
					
				$sql = "SELECT * FROM `prova` WHERE id=2";
				$result = mysqli_query($con, $sql);
				
				if(mysqli_affected_rows($con) == 1){
					echo "Immagine: ";
					$row = mysqli_fetch_array($result);
					echo "<div>";
					echo "<p>".$row['nome']."</p><br/><br/>";
					
					
					
					echo '<img src="data:image/jpeg;base64,'.base64_encode($row['immagine']).'"/>';
					
					
					
					
					echo "</div>";
				}
					
				mysqli_close();
				
			?>
		</div>
	</body>
</html>
