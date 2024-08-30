<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
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

      <h1>connexion</h1>
      <div class="pok_connexion">
         <div class="connexion">
            <h3>Je possède un compte</h3>
            <form action="verif_connexion.php" method="post">          
                  <input class="input" type="email" name="email" placeholder="E-mail" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">
                  <input class="input" type="password" name="password" placeholder="Mot de passe" required>
                  <input class="submit" type="submit" value="Connexion">
            </form>      
        </div>
        
        <div class="inscription">
            <h3>Je crée un compte</h3>
            <form action="verif_inscription.php" method="post" enctype="multipart/form-data">                  
                  <input class="input" type="text" name="pseudo" placeholder="Pseudo" value="<?php echo isset($_COOKIE['pseudo']) ? $_COOKIE['pseudo'] : ''; ?>">
                	 <input class="input" type="email" name="email" placeholder="E-mail" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">
                	<input class="input" type="password" name="password" placeholder="Mot de passe" required>
                    <p>Image de profil :<input type="file" name="image" accept="image/png,image/jpeg,image/gif"></p>
                	<input class="submit" type="submit" value="Inscription">
            </form>           
        </div>
      </div>

    </main>

    <?php include("includes/footer.php"); ?>
    
  </body>
</html>
