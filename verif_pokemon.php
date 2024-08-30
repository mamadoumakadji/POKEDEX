<?php
session_start();

include('includes/config.php');

if(!isset($_POST['Nom']) || empty($_POST['Nom'])){
	header('location:add_pokemon.php?message=Il faut remplir tous les champs🤬🤬🤬🤬🤬.');
	exit;
}
if(!isset($_POST['PV']) || empty($_POST['PV'])){
	header('location:add_pokemon.php?message=Il faut remplir tous les champs🤬🤬🤬🤬🤬.');
	exit;
}
if(!isset($_POST['Attaque']) || empty($_POST['Attaque'])){
	header('location:add_pokemon.php?message=Il faut remplir tous les champs🤬🤬🤬🤬🤬.');
	exit;
}
if(!isset($_POST['Défense']) || empty($_POST['Défense'])){
	header('location:add_pokemon.php?message=Il faut remplir tous les champs🤬🤬🤬🤬🤬.');
	exit;
}
if(!isset($_POST['Vitesse']) || empty($_POST['Vitesse'])){
	header('location:add_pokemon.php?message=Il faut remplir tous les champs🤬🤬🤬🤬🤬.');
	exit;
}

// Verifier que le pokemon n'a pas déjà été utilisé
	$q = 'SELECT id FROM pokemon WHERE nom = :Nom';
	$req = $db->prepare($q);
	$req->execute([
		'Nom' => $_POST['Nom']
	]);

	$resultat = $req->fetch();

	if($resultat){
		// Redirection vers la page d'ajout avec un message d'erreur
		header('location:add_pokemon.php?message=Le pokemon a déjà été ajouté🤬🤬🤬🤬🤬.');
		exit;
	}

	
// Enregistrement d'un fichier
if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){

	// Vérifier le type de fichier
	$acceptable = [
		'image/jpeg',
		'image/png',
		'image/gif'
	];

	if(!in_array($_FILES['image']['type'], $acceptable)){
		// Redirection vers la page d'inscription avec un message d'erreur
		header('location:index.php?message=Format de fichier incorrect🤬🤬🤬🤬🤬.');
		exit;
	}


	// Vérifier la taille du fichier

	$maxSize = 1 * 1024 * 1024; // 1Mo

	if($_FILES['image']['size'] > $maxSize){
		// Redirection vers la page d'inscription avec un message d'erreur
		header('location:index.php?message=Le fichier est trop volumineux🤬🤬🤬🤬🤬.');
		exit;
	}

	// Chemin vers le dossier d'uploads
	$path = 'uploads/pokemon';

	// Si le dossier n'existe pas, le créer
	if(!file_exists($path) ){
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
else {
	header('location:add_pokemon.php?message=Il faut remplir tous les champs🤬🤬🤬🤬🤬.');
	exit;
}

$q = 'SELECT id FROM user WHERE email = :email';
$req = $db->prepare($q);
$req->execute([
	'email' => $_SESSION['email']
]);
foreach($req as $row){
	$id = $row['id'];
}

$q = 'INSERT INTO pokemon (nom, pv, attaque, defense, vitesse, image, id_user) VALUES (:nom,:pv,:attaque,:defense,:vitesse,:image, :id_user)';
$req = $db->prepare($q);
$reponse = $req->execute([
	'nom' => $_POST['Nom'],
	'pv' => $_POST['PV'],
	'attaque' => $_POST['Attaque'],
	'defense' => $_POST['Défense'],
	'vitesse' => $_POST['Vitesse'],
	'image' =>  isset($filename) ? $filename : '',
	'id_user' => $id
]);

if($reponse){
	header('location:profile.php?message=Pokemon crée avec succès🤗🤗🤗🤗🤗');
}
 ?>
