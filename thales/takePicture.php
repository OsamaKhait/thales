<?php

    require('config.php');
	// Initialiser la session
	session_start();

    //Fonction pour générer un UUID
    function guidv4($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    $photo_name = guidv4();

    //sur la raspberry 
    //shell_exec('fswebcam -r 1280x720 --no-banner /photos/'.$photo_name.'.jpg');

    //pour la démo
    copy('https://dummyimage.com/1280x720/'.substr(str_shuffle('ABCDEF0123456789'), 0, 6).'/'.substr(str_shuffle('ABCDEF0123456789'), 0, 6).'',
    'photos/'.$photo_name.'.jpg');


    //rechercher du username et mot de passe dans la BDD
    $query = "INSERT INTO photos (photo_name,photo_date)
    VALUES ('".$photo_name."','".date('Y-m-d H:i:s')."')";

    if ($conn->query($query) === TRUE) {
        if(isset($_SERVER['HTTP_REFERER'])){
            header("Location: ".$_SERVER['HTTP_REFERER']); //renvoyer l'utilisateur vers son url d'origine
        }
        else{
            echo "New record created successfully";
        }
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    
?>