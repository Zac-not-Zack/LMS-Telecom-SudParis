<?php
  session_start(); 
  include ("../Outils/outils.php");
    include ("base.php");
    $sql="SELECT * FROM `utilisateur` WHERE login =:login";
    $req1=$bd->prepare ($sql);
    $marqueurs=array('login'=>$_POST['login']);
    $req1->execute($marqueurs);
    $mdp=$req1->fetch();
    $req1->closeCursor () or die(print_r($req1->errorInfo()));
    if ($_POST['mdp']==$mdp['mdp']){
      $verification="true";
    }


  if(isset($_SESSION['login'])==false){
    if ($verification!="true") { // Authentification KO ou tentative de fraude
      header('Location:index.php?error=ok');
        exit();
    }
    else {
      $_SESSION['login']=$_POST['login'];
      $_SESSION['id']=$mdp['id'];
      }
    } 
    
?>
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
        
    <!-- Le contenu (1 seule section suffit) -->    
    <section>
    <?php
    
    if($verification=="true") {
      header ('Location: ./profile.php');
      exit();
      }
      
      else{
      header ('Location: ./index.php?error=ok');
      exit();
      }
      
      
    ?>
    </section>
  </body>
</html>