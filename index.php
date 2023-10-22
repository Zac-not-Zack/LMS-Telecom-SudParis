<?php
  session_start();
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
        
    <!-- Le contenu (1 seule section suffit) -->    
    <section>
    <div id="login">
      <h1 class='login'>Bienvenue à LMS de Télécom SudParis!</h1>
      <?php 
      if(isset($_GET['error'])==true){
      if($_GET['error']=="ok"){//si le login ou mot de passe incorrect
      echo "<p><strong>Login ou mot de passe incorrect. Veuillez recommencer.</strong></p>";
      }}

      if(isset($_GET['exitcode'])==true){
      if ($_GET['exitcode']=="oui"){//si on déconnecte de notre compte
      echo "<p><strong>Vous avez été déconnecté.</strong></p>";}
    }
      //(isset($_GET{'error'})==TRUE)
      if (isset($_SESSION['authentifie'])==true)
      {header('Location:profile.php');
      exit();}
      ?>
      <p>Veuillez vous identifier</p>
      
      <form method="POST" action="./connex1.php?"><!pour sécuriser les données fourni par l'utilisateur quand il tape dans le navigateur>
        <p> <label class='login' for="login">Login</label>
          <input id="login" name="login" type="text" /> <!required-saisir obligatoire><!autofocus->
        </p>
        <p> <label  class='login' for="mdp">Mot de passe</label><!label-pour mettre un label>
          <input id="mdp" name="mdp" type="password"  />
        </p>
        
        <p> 
          <button id="envoi" name="envoi" type="submit" value="envoi">Connnexion</button> 
        </p>
        
      </form>
      
      
      </div>
    </section>
  </body>
</html>