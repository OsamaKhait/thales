<?php
    require('config.php');
    include_once 'includes/header.php';
?>
<?php
    if (isset($_SESSION['username'])) {// si l'utilisateur est connecté, on lui affiche le contenue de la page
        include_once 'display_photos_main.php';
    }
    else{//Si l'utilisateur n'est pas connecté, on le redirige vers la page d'où il vient
		header("Location: index.php");
    }
?>
<?php
    include_once 'includes/footer.php';
?>