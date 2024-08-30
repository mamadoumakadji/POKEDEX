<?php
  session_start();
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>

   <?php include("includes/header.php"); ?>

    <main>
        <?php
      if(isset($_GET['message']) && !empty($_GET['message'])){
        echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
      }
      ?>
        <div id="content-index">
          <img src="images/pikachu.png">
          <h1>BIENVENUE SUR LE POKEDEX DE L'ESGI!!!🤗🤗🤗🤗🥳🥳</h1>
        </div> 
    </main>
  
    <?php include("includes/footer.php"); ?>
    
  </body>
</html>
