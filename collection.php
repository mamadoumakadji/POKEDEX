<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Collection</title>
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
      <h1>Tous les pokemons</h1>
        <div class="pok_collection">
            <?php

            include("includes/config.php");

            $req = $db->query('SELECT * FROM pokemon ORDER BY nom ASC');
            
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
                    }} 
            ?>
        </div>
      </main>

      <?php include("includes/footer.php"); ?>

  </body>
</html>
