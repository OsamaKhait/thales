<?php
require('config.php');
session_start();

if (isset($_POST['username']) && isset($_POST['password'])){
    //WHY stripslashes ???
	$username = stripslashes($_POST['username']);
    $password = stripslashes($_POST['password']);

    //why mysqli_real_escape_string ?
	$username = mysqli_real_escape_string($conn, $username);
	$password = mysqli_real_escape_string($conn, $password);

    //rechercher du username et mot de passe dans la BDD
    $query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";

    //récupérer le résultat de la BDD
	$result = mysqli_query($conn,$query);
	$rows = mysqli_num_rows($result);

	if($rows==1){ //créer une variable username dans la session de l'utilisateur
	    $_SESSION['session_start'] = time(); //ajouter l'heure de la connexion
	    $_SESSION['username'] = $username;
	    header("Location: ".$_SERVER['HTTP_REFERER']); //renvoyer l'utilisateur vers son url d'origine
	}else{// sinon, problème de username ou du mot de passe
		$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";//TODO ajouter la gestio des erreurs si l'utilisateur n'est pas correct
	}
}