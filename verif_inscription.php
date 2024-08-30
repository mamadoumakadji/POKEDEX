<?php
	if( !isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password']) ){
	
	// Redirection vers la page d'inscription avec un message d'erreur
		header('location:connexion.php?message=Vous devez remplir les 2 champs🤬🤬🤬🤬🤬.');
		exit;
	}

	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

		// Redirection vers la page d'inscription avec un message d'erreur
		header('location:connexion.php?message=Email invalide🤬🤬🤬🤬🤬.');
		exit;
	}

/* Pour que le mot de passe prends en compte le majuscule, minuscule et le chiffre on insert ces parametres là */
	$password = $_POST['password'];
	$majuscule = preg_match('@[A-Z]@', $password);
	$minuscule = preg_match('@[a-z]@', $password);
	$chiffre = preg_match('@[0-9]@', $password);

	if(strlen($_POST['password']) < 8 || !$majuscule || !$minuscule || !$chiffre ){
	
	// Redirection vers la page d'inscription avec un message d'erreur
	header('location:connexion.php?message=Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule et un chiffre🤬🤬🤬🤬🤬.');
	exit;
	}

	include('includes/config.php');


// Vérification que l'email n'est pas déjà utilisé
	$q = 'SELECT id FROM user WHERE email = :email';
	$req = $db->prepare($q);
	$req->execute([
		'email' => $_POST['email']
	]);

	$resultat = $req->fetch();

	if($resultat){
		// Redirection vers la page d'inscription avec un message d'erreur
		header('location:connexion.php?message=Cet email est déjà utilisé🤬🤬🤬🤬🤬.');
		exit;
	}

	$q = 'SELECT id FROM user WHERE pseudo = :pseudo';
	$req = $db->prepare($q);
	$req->execute([
		'pseudo' => $_POST['pseudo']
	]);

	$resultat = $req->fetch(); 									/*=> pour récuperer le premier élement qui est dans resultat*/

	if($resultat){
		header('location:connexion.php?message=Ce pseudo est déjà utilisé🤬🤬🤬🤬🤬.');	// Redirection vers la page d'inscription avec un message d'erreur
		exit;
	}

	if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){			// Enregistrement d'un fichier

	// Vérification le type de fichier
	$acceptable = [
		'image/jpeg',
		'image/png',
		'image/gif'
	];

	if(!in_array($_FILES['image']['type'], $acceptable)){
		header('location:connexion.php?message=Format de fichier incorrect🤬🤬🤬🤬🤬.');	// Redirection vers la page d'inscription avec un message d'erreur
		exit;
	}

	// Vérifier la taille du fichier
	$maxSize = 1 * 1024 * 1024; // 1Mo

	if($_FILES['image']['size'] > $maxSize){

		// Redirection vers la page d'inscription avec un message d'erreur
		header('location:connexion.php?message=Le fichier est trop volumineux🤬🤬🤬🤬🤬.');
		exit;
	}

	// Chemin vers le dossier d'uploads
	$path = 'uploads';

	// Si le dossier n'existe pas, le créer
	if(!file_exists($path)){
		mkdir($path, 0777);
	}

	// Enregistrement du fichier
	$filename = $_FILES['image']['name'];

	// Renommer l'image
	// image-15464785.ext

	// Récupérer l'extension
	$array = explode('.', $filename);
	$ext = end($array);

	$filename = 'image-' . time() . '.' . $ext;
	// Attention aux doublons si 2 fichiers envoyés dans la même seconde.

	$destination = $path . '/' . $filename;
	move_uploaded_file($_FILES['image']['tmp_name'], $destination);

}

// Requete preparée avec des clés
	$q = 'INSERT INTO user (pseudo,email, password, image) VALUES (:pseudo,:email, :password, :image)';
	$req = $db->prepare($q);
	$reponse = $req->execute([
		'pseudo' => $_POST['pseudo'],
		'email' => $_POST['email'],
		'password' => hash('sha512', $_POST['password']),
		'image' =>  isset($filename) ? $filename : ''
	]);
		// Créer un cookie qui expire dans une heure
	setcookie('email',$_POST['email'],time() + 3600);
	setcookie('pseudo',$_POST['pseudo'],time() + 3600);


	if($reponse){
		// Redirection vers l'accueil avec un message de succès.
		header('location:index.php?message=Compte créé avec succès☺☺☺☺☺!&type=success');
		exit;
		
	}else{
		// Redirection vers la page d'inscription avec un message d'erreur
		header('location:connexion.php?message=Erreur lors de l\'insertion en base de données🤬🤬🤬🤬🤬.');
		exit;
	}
