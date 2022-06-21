<section class="py-5 text-center container">
<div class="d-flex justify-content-center">
    <form class="searchPhotos_form" method="POST" action="display_photos.php">
    <label for="start_date">Date début</label>
    <input type="datetime-local" id="start_date" name="start_date" value="<?php if (isset($_POST['start_date'])) echo $_POST['start_date']; else echo date('Y-m-d\T00:00'); /*date par défaut : aujourd'hui à 00:00 */ ?>">

    <label for="end_date">Date fin</label>
    <input type="datetime-local" id="end_date" name="end_date" value="<?php if (isset($_POST['end_date'])) echo $_POST['end_date']; else echo date('Y-m-d\T23:59') /*date par défaut : aujourd'hui à 23:59 */ ?>">

    <button type="submit">Rechercher</button>
    </form>
</div>
</section>

<?php
    $start_date = date('Y-m-d 00:00:00');    //la date de début par défaut est celle d'aujourd'hui à 00:00
    $end_date = date('Y-m-d 23:59:59');      //la date de fin par défaut est celle d'aujourd'hui à 23:59

    //Vérifier si les variables sont définies et si elles ne sont pas vides
    if( isset($_POST['start_date']) && !empty($_POST['start_date']) || 
        isset($_POST['end_date']) && !empty($_POST['end_date']) ){
        $start_date = date('Y-m-d H:i:00', strtotime($_POST['start_date']));   //Transofmer la date de début en format AnnéeMoisJourHeureMinute 
        $end_date = date('Y-m-d H:i:00', strtotime($_POST['end_date']));       //Transofmer la date de fin en format AnnéeMoisJourHeureMinute 
    }
    
    //rechercher du username et mot de passe dans la BDD
    $query = "SELECT `photo_name`, `photo_date`
        FROM `photos` 
        WHERE photo_date 
        BETWEEN '$start_date' AND '$end_date'
        ORDER BY `photo_date`";

    //récupérer le résultat de la BDD
	$result = mysqli_query($conn,$query);
    if (!$result){
        die('Problème de recherche.');
    }
    else{
        echo "<div id='photos_atb_container' class='container'>";
        $newDate="";
        while($row = mysqli_fetch_array($result)){
            $Ymd_photo_date= date('Y-m-d', strtotime($row['photo_date']));
            if($Ymd_photo_date !== $newDate){
                $newDate=$Ymd_photo_date;
                echo "<p>".$Ymd_photo_date."</p>";
            }
            echo "<img id='".$row['photo_name']."' class='photos_atb img-thumbnail ' src='photos/".$row['photo_name'].".jpg' width='320px' height='180px'>";
        }
        echo "</div>";
    }
?>
</main>