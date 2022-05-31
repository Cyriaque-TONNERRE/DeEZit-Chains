<?php require './header.php';
if(!(isset($_SESSION["username"]))){
    header('Location: login.php');
}
else{
    $cookie = false;
    if(isset($_COOKIE["valid"])){
        setcookie ("valid", "", time() - 3600,"/");
        $cookie = true;
    }
    function getScore($pseudo){
        require './connexion_db.php';
        $requete = "SELECT time_trial FROM user WHERE username = '$pseudo'";
        $resultat = mysqli_query($connexion, $requete); //Executer la requete
        if ($resultat == FALSE) {
            echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
            die();
        }
        $row = mysqli_fetch_assoc($resultat);
        return $row["time_trial"];
    }
    $score = getScore($_SESSION["username"]);

    if(isset($_POST[2])){
        if($_POST[2] == ':'){
            $time_left = $_POST[0] * 600 + $_POST[1] * 60 + $_POST[3] * 10 + $_POST[4];
            
            if($time_left >= 600){
                $time_left = 600;
                $pseudo = $_SESSION["username"];
                require './connexion_db.php';
                $score = 0;
                $requete = "UPDATE user SET time_trial = '$score' WHERE username = '$pseudo'";
                $resultat = mysqli_query($connexion, $requete); //Executer la requete
            }
            else{
                if($cookie == true){
                    $cookie = false;
                    $pseudo = $_SESSION["username"];
                    require './connexion_db.php';
                    $score++;
                    $requete = "UPDATE user SET time_trial = '$score' WHERE username = '$pseudo'";
                    $resultat = mysqli_query($connexion, $requete); //Executer la requete
                }
            }
        }
    }
    else{
        $time_left = 600;
        //reset tout
        $pseudo = $_SESSION["username"];
        require './connexion_db.php';
        $score = 0;
        $requete = "UPDATE user SET time_trial = '$score' WHERE username = '$pseudo'";
        $resultat = mysqli_query($connexion, $requete); //Executer la requete
    }
}




?>

    <main>
        <div id="minuteur"></div>
        <div id="score">Score : <?php echo $score; ?></div>
        <script>
            function alarme(tps){
                let temps = tps;
                const timerElement = document.getElementById("minuteur");

                setInterval(() => {
                    let minutes = parseInt(temps / 60, 10);
                    let secondes = parseInt(temps % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    secondes = secondes < 10 ? "0" + secondes : secondes;

                    timerElement.innerText = `${minutes}:${secondes}`;
                    temps = temps <= 0 ? 0 : temps - 1;
                }, 1000);

            }

            <?php
                echo "var time_left ='$time_left';";
            ?>
            alarme(time_left);
        </script>


            <div class="game">
                <?php
                if (!(isset($_COOKIE['time_lvl']))){
                    setcookie("time_lvl", "0", 61000);
                }


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
	</main>
	
	
    <footer>
        
    </footer>
	
</body>