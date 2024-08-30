<?php
	session_start();
	include('includes/connexion_check.php');
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Ajout</title>
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
			<div class="ajout">
			<h1>AJOUTER UN POKEMON</h1>
				<form action="verif_pokemon.php" method="post" enctype="multipart/form-data">
							<input class="input" type="text" name="Nom" placeholder="Nom">
							<input class="input" type="number" name="PV" placeholder="PV">
							<input class="input" type="number" name="Attaque" placeholder="Attaque">
							<input class="input" type="number" name="Défense" placeholder="Défense">
							<input class="input" type="number" name="Vitesse" placeholder="Vitesse">
							<p><strong>Image :</strong><input type="file" name="image" accept="image/png,image/jpeg,image/gif"></p>
							<input class="submit" type="submit" value="Ajouter">
						</div>
				</form>        
		</main>

		<?php include("includes/footer.php"); ?>
	
	</body>
</html>
