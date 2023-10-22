<?php
	session_start();
	
	include("./base.php");
	$sql="SELECT titre, description FROM cours c JOIN estInscrit e ON c.idcours=e.idcours JOIN utilisateur u ON u.login=e.login WHERE u.login =:login";
	$req = $bd->prepare($sql);
	$marquers=array('login'=>$_SESSION['login']);
	$req->execute($marquers);
	$lesEnreg=$req->fetchall();
	$req->closeCursor();
	
	if(isset($_SESSION['login'])==false){
		
			header('Location:index.php?msg=err2');
			exit();
		
		
		}

?>		


<!DOCTYPE HTML>
<html>
	  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" size="32x32" href="logo.png">
    <img src="tsp.png" alt="logo" height="120px" width="340px">
    <title>INT'études</title>
  </head>
  <body>
    <!-- L'en-tête -->
    <header>
      <p>LMS de Télécom SudParis</p>
    </header>
<?php
$_SESSION['authentifie']="oui";	
$perlukanmenuprofile="oui";
include("menu.php");
?>
		<!-- La section -->
		<section>

		<?php
			echo '<br>';
			echo'<table style="margin: 0px auto;"><tr><td><b>Module</b></td><td><b>Description</b></td></tr>';
			foreach($lesEnreg as $cours){
					
					echo'<tr><td>'.$cours['titre'].'</td>';
					echo'<td>'.$cours['description'].'</td></tr>';
				}
				echo'</table>';
			?>
		</section>
	</body>
</html>