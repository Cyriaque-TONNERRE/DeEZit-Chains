<?php require './header.php'; ?>
<link rel='stylesheet' href='../css/adventure.css'>

<main>

    <div class="game">
        <?php
        $id = "Niv".$_GET["id"];


        include("connexion_db.php");
        if (isset($_SESSION["username"])) {
            $requete2 = "SELECT * FROM user where username='$_SESSION[username]'";
            $resultat2 = mysqli_query($connexion,$requete2);
            $row = mysqli_fetch_assoc($resultat2);
            if (isset($row["history_lvl"])){

                if ($_GET["id"] > $row["history_lvl"]) {

                $requete = "UPDATE user SET history_lvl='$_GET[id]' WHERE username='$_SESSION[username]'";
                $resultat = mysqli_query($connexion, $requete);
                if ($resultat == false) {
                    echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
                    die();
                }
            }
        }
        }
        else {
            if (isset($_COOKIE["history_lvl"])) {
                if ($_GET["id"] > $_COOKIE["history_lvl"]) {
                    setcookie("history_lvl", $_GET['id'], time() + (365 * 24 * 3600));
                }
            }
            else {
                setcookie("history_lvl", $_GET['id'], time() + (365 * 24 * 3600));
            }
        }

        $json = file_get_contents('../level.json');
        $data = json_decode($json, false);
        $tab = $data->$id->level;
        $colours = 0;
        $size = count($data->$id->level);
        $red = false;
        $green = false;
        $purple = false;
        $yellow = false;
        $blue = false;
        foreach ($tab as $cle=>$val) {
            $split =  str_split($val);
            foreach ($split as $clef=>$vale) {
                if ($vale == 'r' || $vale == 'b' || $vale == 'g' || $vale == 'y' || $vale == 'p') {
                    $colours++;
                }
            }
        }


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
                            echo "<td class='nordgauchebas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter nordgauchebas' id='1'>X</td>";
                        }
                    }
                    else if(($droite == false) && ($gauche == false) && ($bas == false)){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='droitegauchebas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter droitegauchebas' id='1'>X</td>";
                        }
                    }
                    else if(($droite == false) && ($nord == false) && ($bas == false)){
                        if (ctype_digit($tab[$colonne][$ligne])) {
                            echo "<td class='droitenordbas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter droitenordbas' id='1'>X</td>";
                        }
                    }
                    else if(($droite == false) && ($nord == false) && ($gauche == false)){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='droitenordgauche case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter droitenordgauche' id='1'>X</td>";
                        }
                    }
                    else if(($nord == false) && ($gauche == false)){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='nordgauche case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter nordgauche' id='1'>X</td>";
                        }
                    }
                    else if(($nord == false) && ($droite == false)){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='norddroite case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter norddroite' id='1'>X</td>";
                        }
                    }
                    else if(($nord == false) && ($bas == false)){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='nordbas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter nordbas' id='1'>X</td>";
                        }
                    }
                    else if(($gauche == false) && ($bas == false)){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='gauchebas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter gauchebas' id='1'>X</td>";
                        }
                    }
                    else if(($gauche == false) && ($nord == false)){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='gauchenord case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter gauchenord' id='1'>X</td>";
                        }
                    }
                    else if(($gauche == false) && ($droite == false)){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='gauchedroite case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter gauchedroite' id='1'>X</td>";
                        }
                    }
                    else if(($bas == false) && ($droite == false)){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='basdroite case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter basdroite' id='1'>X</td>";
                        }
                    }
                    else if($gauche == false){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='gauche case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter gauche' id='1'>X</td>";
                        }
                    }
                    else if($droite == false){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='droite case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter droite' id='1'>X</td>";
                        }
                    }
                    else if($nord == false){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='nord case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter nord' id='1'>X</td>";
                        }
                    }
                    else if($bas == false){
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='bas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." letter bas' id='1'>X</td>";
                        }
                    }
                    else{
                        if (ctype_digit($tab[$colonne][$ligne])){
                            echo "<td class='case unused'' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                        } else {
                            echo "<td draggable='true' class='".$tab[$colonne][$ligne]." letter'>X</td>";
                        }
                    }

                    if($tab[$colonne][$ligne] == 'g'){
                        $green = true;

                    }
                    else if($tab[$colonne][$ligne] == 'b'){
                        $blue = true;

                    }
                    else if($tab[$colonne][$ligne] == 'y'){
                        $yellow = true;

                    }
                    else if($tab[$colonne][$ligne] == 'p'){
                        $purple = true;

                    }

                }
                else{
                    echo "<td class=invisible >".$tab[$colonne][$ligne]."</td>";
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


        <footer>

        </footer>

        </body>
