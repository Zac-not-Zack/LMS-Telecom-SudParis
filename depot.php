<?php
	session_start();
	
	include("./base.php");
	$sql="SELECT titre, c.idcours ,u.type FROM cours c JOIN estInscrit e ON c.idcours=e.idcours JOIN utilisateur u ON u.login=e.login WHERE u.login =:login";
	$req = $bd->prepare($sql);
	$marquers=array('login'=>$_SESSION['login']);
	$req->execute($marquers);
	$lesEnreg=$req->fetchall();
	$req->closeCursor();

	$sql3="SELECT type FROM utilisateur WHERE login =:login";
	$req3 = $bd->prepare($sql3);
	$marquers=array('login'=>$_SESSION['login']);
	$req3->execute($marquers);
	$lesEnreg3=$req3->fetch();
	$req3->closeCursor();
	
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
			if($lesEnreg3['type']=="etudiant"){
				echo "<p>Vous n'etes pas autorisé à faire cette opération</p>";
				header('Location:profile.php');
    		 	exit();
			}
			?>
			<p>Selectionner un cours :</p>
			<br>
			<form method="post" action="depot.php?select=ok">
				<select name="cours">
					<option value="">--Veuillez selectionner un cours--</option>

					<?php

						foreach($lesEnreg as $cours){//afficher les amis

							//whitespace

							echo'<option value=' . $cours['titre'] . '>' . $cours['titre'] .'</option>';
							
						}
					?>

				</select>
				<br>
				<br>
				<div class="input">
				<input  type="submit" value="Submit the form"/>
				</div>
			</form>

			<?php
			  	if(isset($_GET['select'])==true){
					if($_GET['select']=="ok"){

						//var_dump($_POST['cours']);


						$sql2="SELECT u.login, u.nom, u.prenom
								FROM depot d
								JOIN devoir dv ON d.idactivity = dv.idactivity
								JOIN activity a ON dv.idactivity = a.idactivity
								JOIN utilisateur u ON d.idutilisateur = u.login
								JOIN section s ON a.idsection = s.idsection
								JOIN cours c ON s.idcours = c.idcours
								WHERE c.titre = '{$_POST['cours']}'";

						$req2 = $bd->prepare($sql2);
						$req2->execute();
						$lesEnreg2=$req2->fetchall();
						$req2->closeCursor();}

						//echo $_POST['cours'];

						
						echo'<p>Liste des étudiants avec devoir de "'.$_POST['cours'].'" à rendre</p>';
						echo '<br>';
						echo'<table style="margin: 0px auto;"><tr><td><b>Nom</b></td><td><b>Prénom</b></td></tr>';
						
						foreach($lesEnreg2 as $devoir){//afficher les amis
							
							//whitespace
							echo'<tr><td>'.$devoir['nom'].'</td>';
							echo'<td>'.$devoir['prenom'].'</td></tr>';
							}
							
						
						echo'</table>';
					
						}
						
				
		?>
		</section>
	</body>
</html>