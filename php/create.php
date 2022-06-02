<?php require './header.php';
$err = "";

if(isset($_POST["submit"])){
    $err = "";
    if(isset($_FILES["fichier"]) && ($_FILES["fichier"]["error"] == 0)){
        if(($_FILES["fichier"]["type"] == "application/json")){
            if($_FILES["fichier"]["size"] < 1000000){

                $nomfichier = "../lvl_crea/".time().".".basename($_FILES["fichier"]["type"]);
                move_uploaded_file($_FILES["fichier"]["tmp_name"],$nomfichier);
                //Ajouter la vérification ici avec le solveur
                $json = file_get_contents($nomfichier);
                $data = json_decode($json, false);
                if(isset($data->name) && isset($data->level) && isset($data->author)){ //Les champs existent
                    $valid = true;
                    $tab = $data->level;
                    $size = count($tab);
                    foreach ($tab as $cle=>$val) {
                        if(count(str_split($val)) != $size){
                            $valid = false;
                        }
                    }
                    if($valid){
                        header("Location:importgame.php?id=$nomfichier");
                    }
                    else{
                        $err = "File is not compatible.";
                        unlink($nomfichier);
                        
                    }
                }
                else{
                    $err = "File is not compatible.";
                    unlink($nomfichier);
                    
                }

            }
            else{
                $err = "File too large.";
            }
        }
        else{
            $err = "Only json files are accepted.";
        }
    }
    else{
        $err = "Problem while importing the file.";
    }

    $dos ="../lvl_crea/";
    $dir = opendir($dos);
    while($file = readdir($dir)){
        if(($file != ".") && $file != ".."){
            $temps = explode(".", $file);
            if(intval($temps[0]) + 600 < time()){
                unlink("../lvl_crea/".$file);
            }
        }	
    }
}

?>
<script>function removeClass() {
        var element = document.getElementById("submit");
        element.classList.remove("hidden");
}</script>
<div class="error">
    <?php echo $err; ?>
</div>


<form  method="POST" action="" enctype="multipart/form-data">
    <div class="but">
        <input type="submit" name="submit" id="submit" class= "send hidden" value="Importer">
        <label for="fichier" onclick="removeClass()" class="mode2">
        <img src="../image/folder.svg" id="folder" alt="folder" draggable="false"/>
            </img>
            <div class="text2">Import level</div>
    </label>

        <a draggable='false' class="gamemode mode" href="creative.php">
            <img src="../image/edit.svg " id="edit" alt="edit" draggable="false"/>
            <div class="text">Create level</div>
        </a></div>
    <input type="file" name="fichier" id="fichier" accept=".json" class="upload hidden" require/>

</form>
