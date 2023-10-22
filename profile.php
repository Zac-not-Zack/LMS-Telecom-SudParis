<?php
	session_start();
	
	include("./base.php");
	$sql="SELECT * FROM utilisateur WHERE login =:login";
	$req = $bd->prepare($sql);
	$marquers=array('login'=>$_SESSION['login']);
	$req->execute($marquers);
	$lesEnreg=$req->fetch();
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
			
			//affichage de profil 
			echo '<br>';
			echo '<img class=profilepic size=auto src="profil.jpg">';
		
		?>
			<h1> <?php echo("{$lesEnreg['prenom']} {$lesEnreg['nom']} "); ?></h1>
			<p> <?php 
			
			echo '<br>';
			echo("Courrier : {$lesEnreg['courrier']}<br>");
			echo '<br>';
			echo("Promotion : {$lesEnreg['population']}");
			echo '<br>';
			echo '<br>';
			if ($lesEnreg['type']=="etudiant"){
				echo("Statut : Etudiant(e)");}

			else{
				echo("Statut : Enseignant(e)");
			}
			echo '<br>';
		
			
			?></p>
			
			
			
		
		</section>
	</body>
</html>
		

