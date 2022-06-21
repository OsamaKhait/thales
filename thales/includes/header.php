<?php
    date_default_timezone_set('Europe/Paris');

	// Initialiser la session
	session_start();

    //Vérifier le début de la session de l'utilisateur
    if (isset($_SESSION['session_start']) && (time() - $_SESSION['session_start'] > 3600)) {//Si la session est supérieure à 1 heure 
        session_unset(); //on enlève la session
        session_destroy(); //on détruit la session
    }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<!-- <link rel="stylesheet" href="css/basesite.css" /> -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
		<title>ATB</title>
	</head>

    <body>

    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <b><a class="navbar-brand" href="#">PHOTO ATB</a></b>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="takePicture.php" class="nav-link link-light">Prendre une photo</a></li>
                    <?php
                        if (isset($_SESSION['username'])) {
                            echo '<li><a href="display_photos.php" class="nav-link link-light">Accéder aux photos </a></li>';
                        }
                    ?>
                </ul>
            
                <?php
                    if (isset($_SESSION['username'])) {
                        echo '<span class="nav-link disabled px-2">'.$_SESSION["username"].'</span>';
                        echo '
                                <form class="logout_btn" method="POST" action="logout.php">
                                <button type="submit" class="btn btn-warning">Se déconnecter</button>
                                </form>';
                    }
                    else { ?>
                        <form class="login_form" method="POST" action="login.php">
                            <input type="text" name="username" placeholder="Identifiant">
                            <input type="password" name="password" placeholder="Mot de passe">
                            <input type="submit" value="Connexion " name="submit" class="btn btn-outline-light me-2">
                        </form>   
                    <?php } ?>
            </div>
        </div>
    </header>