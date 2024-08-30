<?php
  session_start();
  include('includes/connexion_check.php');
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profil</title>
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
        <h1>Mon compte</h1>
          <div id='profil-container'>
        <?php

        /* INFORMATIONS */ 
          echo "<h2>Mes infos</h2>";

          if (isset($_SESSION['email'])){

            include("includes/config.php");

            $q = 'SELECT * FROM user WHERE email = :email';
            $req = $db->prepare($q);
            $req->execute([
            	'email' => $_SESSION['email']
            ]);

            foreach ($req as $row) {

              if (isset($row['pseudo'])) {
                echo "<p> <strong> Pseudo : </strong> " . $row['pseudo'] . "</p>";
              }
              
              if (isset($row['email'])) {
                echo "<p> <strong> Email : </strong>" . $row['email'] . "</p>";
              }

              if (isset($row['image'])) {
                echo "<div class='pdp'> <p><strong> Image de profil : </strong></p> 
                                        <img src='uploads/" . $row['image'] . "'>
                      </div>";
              }
            }
          ?>
        </div>
          <!-- Pour tracer une ligne horizontale -->
          
          <hr><br>
          <h2>Mes pokemons</h2>
        <div class="pok_profile">
            <?php

              $q = 'SELECT * FROM pokemon WHERE id_user = :id';
              $req = $db->prepare($q);
              $req->execute([
                'id' => $row['id']
              ]);

              foreach ($req as $row) {
                  if (isset($row['nom']) && isset($row['pv']) && isset($row['attaque']) && isset($row['defense']) && isset($row['vitesse']) && isset($row['image'])) {
                  echo "

                       <div class='pokepoke'>
                            <div class='desc'>
                                <p class='pokpok'> <strong>". $row['nom'] . "</strong></p>
                                 <p>PV : " . $row['pv'] . "</p>
                                 <p>Attaque : " . $row['attaque'] . " 
                                 </p><p>Défense : " . $row['defense'] . " 
                                 </p><p>Vitesse : " . $row['vitesse'] ." </p> 
                            </div>
                        <img src='uploads/pokemon/" . $row['image'] . "'> 
                    </div>";
                  }}}
            ?>
        </div>
    </main>
  
    <?php include("includes/footer.php"); ?>
  </body>
</html>