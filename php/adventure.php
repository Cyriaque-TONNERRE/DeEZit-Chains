<?php require './header.php';
function getScore($pseudo){
    require './connexion_db.php';
    $requete = "SELECT adventure_lvl FROM user WHERE username = '$pseudo'";
    $resultat = mysqli_query($connexion, $requete); //Executer la requete
    if ($resultat == FALSE) {
        echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
        die();
    }
    $row = mysqli_fetch_assoc($resultat);
    return $row["adventure_lvl"];
}
$score = getScore($_SESSION["username"]);
if(!(isset($_SESSION["username"]))){
    header('Location: login.php');
}
else if(isset($_COOKIE["valid"])){
    $pseudo = $_SESSION["username"];
    require './connexion_db.php';
    $score++;
    $requete = "UPDATE user SET adventure_lvl = '$score' WHERE username = '$pseudo'";
    $resultat = mysqli_query($connexion, $requete); //Executer la requete
    
}



?>
<main>
    <div class="score">Score : <?php echo $score; ?></div>
    <div class="game" id="game">
    <?php


    $seed = time();
    $colours = time()%5 + 1;
    $tab = array();
    $green = false;
    $purple = false;
    $yellow = false;
    $blue = false;

    if (DIRECTORY_SEPARATOR == '\\') {
        exec("randomGenerate.exe $seed $colours", $tab);
    } else {
        exec("chmod a+x ./randomGenerate");
        exec("./randomGenerate $seed $colours", $tab);
    }
    $size = count($tab);
    echo "<table id='tableau'>";
    for ($colonne = 0; $colonne < $size; $colonne++){
        echo "<tr>";
        for ($ligne = 0; $ligne < $size; $ligne++){
            if($tab[$colonne][$ligne] != 0){
                //Test pour savoir où placer les bordures
                $nord = false;
                $droite = false;
                $gauche = false;
                $bas = false;
                if($colonne > 0){
                    if($tab[$colonne-1][$ligne] != 0){
                        $nord = true;
                    }
                }
                if($ligne > 0){
                    if($tab[$colonne][$ligne-1] != 0){
                        $gauche = true;
                    }
                }
                if($colonne < $size-1){
                    if($tab[$colonne+1][$ligne] != 0){
                        $bas = true;
                    }
                }
                if($ligne < $size-1){
                    if($tab[$colonne][$ligne+1] != 0){
                        $droite = true;
                    }
                }
                //Une fois qu'on sait où sont les chiffres, on ajuste la class pour ajuster les bordures de la bonne façon
                if(($nord == false) && ($gauche == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nordgauchebas case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter nordgauchebas tab' id='0'>X</td>";
                    }
                }
                else if(($droite == false) && ($gauche == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='droitegauchebas case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter droitegauchebas tab' id='0'>X</td>";
                    }
                }
                else if(($droite == false) && ($nord == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])) {
                        echo "<td class='droitenordbas case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter droitenordbas tab' id='0'>X</td>";
                    }
                }
                else if(($droite == false) && ($nord == false) && ($gauche == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='droitenordgauche case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter droitenordgauche tab' id='0'>X</td>";
                    }
                }
                else if(($nord == false) && ($gauche == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nordgauche case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter nordgauche tab' id='0'>X</td>";
                    }
                }
                else if(($nord == false) && ($droite == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='norddroite case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter norddroite tab' id='0'>X</td>";
                    }
                }
                else if(($nord == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nordbas case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter nordbas tab' id='0'>X</td>";
                    }
                }
                else if(($gauche == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauchebas case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter gauchebas tab' id='0'>X</td>";
                    }
                }
                else if(($gauche == false) && ($nord == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauchenord case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter gauchenord tab' id='0'>X</td>";
                    }
                }
                else if(($gauche == false) && ($droite == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauchedroite case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter gauchedroite tab' id='0'>X</td>";
                    }
                }
                else if(($bas == false) && ($droite == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='basdroite case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter basdroite tab' id='0'>X</td>";
                    }
                }
                else if($gauche == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauche case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter gauche tab' id='0'>X</td>";
                    }
                }
                else if($droite == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='droite case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter droite tab' id='0'>X</td>";
                    }
                }
                else if($nord == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nord case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter nord tab' id='0'>X</td>";
                    }
                }
                else if($bas == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='bas case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter bas tab' id='0'>X</td>";
                    }
                }
                else{
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='case unused tab' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter tab' id='0'>X</td>";
                    }
                }

                if($colours >= 2 && $tab[$colonne][$ligne] == 'g'){
                   $green = true;

                }
                else if($colours >= 3 && $tab[$colonne][$ligne] == 'b'){
                    $blue = true;

                }
                else if($colours >= 4 && $tab[$colonne][$ligne] == 'y'){
                    $yellow = true;

                }
                else if($colours == 5 && $tab[$colonne][$ligne] == 'p'){
                    $purple = true;

                }
                


                    

                        
            }
            else{
                echo "<td class='invisible tab' id=0>".$tab[$colonne][$ligne]."</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    $clear="clearr()";
    if($blue == true) $clear= $clear.";clearb()";
    if($purple == true) $clear= $clear.";clearp()";
    if($yellow == true) $clear= $clear.";cleary()";
    if($green == true) $clear= $clear.";clearg()";
    echo "<button id='reset' onclick='$clear'>reset</button>";

    
    echo "<script src='../js/red.js'></script>";



    if($blue == true){
        echo "<script src='../js/blue.js'></script>";
    }
    
    if($purple == true){
        echo "<script src='../js/purple.js'></script>";
    }

    
    if($yellow == true){
        echo "<script src='../js/yellow.js'></script>";
    }

    
    if($green == true){
        echo "<script src='../js/green.js'></script>";
    }


    
    ?>
    
    <div id="export_button">
        <?php echo "<button id='reset' onclick='exporter($size)'>Exporter</button>"; ?>
    </div>

    <div class = "export disparition" id="exportationLvl">
        <label for="name">Level Name : </label>
        <input type="text" id="namelvl">
        <button id='closeExporter' onclick='closeExporter()'>X</button>
        <button id='download' onclick='install()'>download</button>
    </div>
    <script src='../js/adventureExport.js'></script>

</main>
	

<footer>

</footer>

</body>
