<?php
if( !isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password']) ){
	// Redirection vers connexion.php avec un message dans l'url
	header('location: connexion.php?message=Vous devez remplir les 2 champs🤬🤬🤬🤬🤬.');
	exit;
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	// Redirection vers connexion.php avec un message dans l'url
	header('location:connexion.php?message=Email invalide🤬🤬🤬🤬🤬.');
	exit;
}


include('includes/config.php');

// Selectionner l'utilisateur avec l'email et le mot de passe envoyés dans le POST
	$q = 'SELECT id FROM user WHERE email = :email AND password = :password';
	$req = $db->prepare($q);
	$req->execute([
		'email' => $_POST['email'],
		'password' => hash('sha512', $_POST['password'])
	]);
	// Créer un cookie qui expire dans une heure
	setcookie('email',$_POST['email'],time() + 3600);

	$resultat = $req->fetch(PDO::FETCH_ASSOC); // renvoie false si aucune ligne de résultat trouvée
	
  // Si un résultat est renvoyé : l'utilisateur existe
	if($resultat){
		
		// Créer une session utilisateur
		session_start();
		
		// Y mettre un paramètre email avec la valeur envoyée via le post
		$_SESSION['email'] = $_POST['email'];

		// Redirection vers l'accueil
		header('location:index.php?message=BIENVENUE!!🤗🤗🥳🥳🥳');
		exit;

	}else{
		
		// Redirection vers connexion.php avec un message dans l'url
		header('location:connexion.php?message=Identifiants incorrects🤬🤬🤬🤬🤬.');
		exit;
	}
?>
