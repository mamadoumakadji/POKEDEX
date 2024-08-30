<header>
	<nav>
		<div class="headerflex">
		<img class="logo"src="images/logo.png">
			<ul>
				<a class="header" href="index.php"> Accueil </a> 
				<a class="header" href="collection.php"> Collection </a> 

				<!-- Affichage de la barre de navigation e--> 
				<?php
					if (isset($_SESSION['email'])){
						echo '<a class="header" href="add_pokemon.php"> Ajouter un pokémon </a>' ;
						echo '<a class="header" href="profile.php"> Mon compte </a>';
						echo '<a class="header" href="deconnexion.php"> Déconnexion </a>';
					}else{
						echo '<a class="header" href="connexion.php"> Connexion </a>';
					}
				?>
			</ul>
		</div>
	</nav>
</header>
