<?php require './header.php';
$err = "";

function est_vrai_chiffre($val){
    if($val == '1' ||$val == '2' ||$val == '3' ||$val == '4' ||$val == '5' ||$val == '6' ||$val == '7' ||$val == '8' ||$val == '9'){
        return true;
    }
    else{
        return false;
    }
}
function voisinsCheck($tab,$x,$y,$size){
    $gauche = false;
    $droite = false;
    $haut = false;
    $bas = false;
    if(($size > $x) && ($x >= 1)){
        //Valeur Gauche
        $gauche = $tab[$y - 1][$x];
    }
    if((0 <= $x) && ($x < $size - 1)){
        //Valeur Droite
        $droite = $tab[$y + 1][$x];
    }
    if(($y >= 1) && ($y > $size)){
        //Valeur Haut
        $haut = $tab[$y][$x - 1];
    }
    if((0 <= $y) && ($y < $size - 1)){
        //Valeur bas
        $bas = $tab[$y][$x + 1];
    }
    if($gauche != false){
        if(est_vrai_chiffre($gauche)){
            return true;
        }
    }
    if($droite != false){
        if(est_vrai_chiffre($droite)){
            return true;
        }
    }
    if($haut != false){
        if(est_vrai_chiffre($haut)){
            return true;
        }
    }
    if($bas != false){
        if(est_vrai_chiffre($bas)){
            return true;
        }
    }
    return false;
    
}

if(isset($_POST["submit"]) || isset($_FILES["fichier"])){
    $err = "";
    $neighbour = false;
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
                        if((count(str_split($val)) != $size) || $size > 10){
                            $err = "File is not compatible.";
                            unlink($nomfichier);
                            $valid = false;
                        }
                    }
                    if($valid){
                        $realisable = false;
                        $colorlist = array("r","g","b","p","y");
                        foreach ($tab as $cle=>$val) {
                            if($realisable == false){
                                foreach ($colorlist as $key=>$col) {           
                                    if(strpos($val,$col) !== false && $realisable == false){
                                        if(!(voisinsCheck($tab,strpos($val,$col),$cle,$size))){
                                            $err = "Level is not possible.";
                                            $valid = false;
                                        }
                                        else{
                                            $realisable = true;
                                        }
                                    }
                                }
                            }
                            
                        }
                        if($realisable == false){
                            unlink($nomfichier);
                            $err = "Level is not possible.";
                            $valid = false;
                        }
                        if($valid){
                            header("Location:importgame.php?id=$nomfichier");
                        }
                        
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

if($err != ""){
    echo "<div class='error'>$err</div>";
}
?>


<script>
    function pushform(){
        document.getElementById("fileupload").submit();
    }
</script>
<form  id="fileupload" method="POST" action="" enctype="multipart/form-data">
    <div class="but">
    
        <label for="fichier" class="mode2">
        <img src="../image/folder.svg" id="folder" alt="folder" draggable="false"/>
            </img>
            <div class="text2">Import level</div>
    </label>

        
    <input type="file" onchange="pushform();" name="fichier" id="fichier" accept=".json" class="upload hidden" require/>

</form>
<a draggable='false' class="gamemode mode" href="creative.php">
            <img src="../image/edit.svg " id="edit" alt="edit" draggable="false"/>
            <div class="text">Create level</div>
        </a></div>
