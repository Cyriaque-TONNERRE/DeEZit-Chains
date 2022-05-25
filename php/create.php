<?php require './header.php';

if(isset($_POST["submit"])){

    if(isset($_FILES["fichier"]) && ($_FILES["fichier"]["error"] == 0)){
        if(($_FILES["fichier"]["type"] == "application/json")){
            if($_FILES["fichier"]["size"] < 1000000){
                //Ajouter la vérification ici avec le solveur





                //Validé, lancement de la partie
                $nomfichier = "../lvl_crea/".time().".".basename($_FILES["fichier"]["type"]);
                move_uploaded_file($_FILES["fichier"]["tmp_name"],$nomfichier);
                header("Location:importgame.php?id=$nomfichier");
            }
        }
    }
}

?>



<form  method="POST" action="" enctype="multipart/form-data">
    <input type="file" name="fichier" id="fichier" accept=".json" class="upload" require/>
    <input type="submit" name="submit" id="submit" class= "send" value="Importer">
</form>

<br>
<a draggable='false' class="gamemode" href="creative.php">
    Créer un niveau
</a>



