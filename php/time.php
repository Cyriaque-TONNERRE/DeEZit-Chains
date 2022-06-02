<?php require './header.php';
if (!(isset($_SESSION["username"]))) {
    header('Location: login.php');
} else {
    $cookie = false;
    if (isset($_COOKIE["valid"])) {
        setcookie("valid", "", time() - 3600, "/");
        $cookie = true;
    }
    function getScore($pseudo)
    {
        require './connexion_db.php';
        $requete = "SELECT current_time_trial FROM user WHERE username = '$pseudo'";
        $resultat = mysqli_query($connexion, $requete); //Executer la requete
        if ($resultat == FALSE) {
            echo "<p>Erreur d'exécution de la requete :" . mysqli_error($connexion) . "</p>";
            die();
        }
        $row = mysqli_fetch_assoc($resultat);
        return $row["current_time_trial"];
    }

    $score = getScore($_SESSION["username"]);

    if (isset($_POST[2])) {
        if ($_POST[2] == ':') {
            $time_left = $_POST[0] * 600 + $_POST[1] * 60 + $_POST[3] * 10 + $_POST[4];

            if ($time_left >= 600) {
                $time_left = 600;
                $pseudo = $_SESSION["username"];
                require './connexion_db.php';
                $score = 0;
                $requete = "UPDATE user SET current_time_trial = '$score' WHERE username = '$pseudo'";
                $resultat = mysqli_query($connexion, $requete); //Executer la requete
            } else {
                if ($cookie) {
                    $pseudo = $_SESSION["username"];
                    require './connexion_db.php';
                    $score++;
                    $requete = "UPDATE user SET current_time_trial = '$score' WHERE username = '$pseudo'";
                    $resultat = mysqli_query($connexion, $requete); //Executer la requete
                    $cookie = false;
                }
            }
        }
    } else {
        $time_left = 600; // Valeur a modifier pour remettre le bon timer (600 pour 10 min)
        //reset tout
        $pseudo = $_SESSION["username"];
        require './connexion_db.php';
        $score = 0;
        $requete = "UPDATE user SET current_time_trial = '$score' WHERE username = '$pseudo'";
        $resultat = mysqli_query($connexion, $requete); //Executer la requete
        $d = $time_left * 5;
        $sw = .1 * $d;
        $r = .5 * ($d - $sw);
        $len = 2 * pi() * $r;
    }
}

?>

<main>
    <div id="minuteur"></div>
    <div id="score">Score : <?php echo $score; ?></div>
    <script>

        function alarme(tps) {
            let temps = tps;
            const timerElement = document.getElementById("bouche");

            setInterval(() => {
                let minutes = parseInt(temps / 60, 10);
                let secondes = parseInt(temps % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                secondes = secondes < 10 ? "0" + secondes : secondes;

                timerElement.innerText = `${minutes}:${secondes}`;
                temps = temps <= 0 ? -1 : temps - 1;
                if (temps === 0) {
                    document.location.href = "timescore.php";
                }
            }, 1000);
        }

        <?php
        echo "var time_left ='$time_left';";
        ?>
        alarme(time_left);
    </script>

    function formatTime(time) {
    let minutes = Math.floor(time / 60);
    let seconds = time % 60;

    <div class="game">
        <?php
        $requete = "SELECT current_time_trial FROM user WHERE username = '$pseudo'";
        $resultat = mysqli_query($connexion, $requete); //Executer la requete
        $id = "Niv".$resultat;

        $json = file_get_contents('../json/level_time_trial.json');
        $data = json_decode($json, false);

        $seed = $data->$id->seed;
        $colours = 0;
        $size = count($data->$id->seed);
        $red = false;
        $green = false;
        $purple = false;
        $yellow = false;
        $blue = false;
        foreach ($seed as $cle=>$val) {
            $split =  str_split($val);
            foreach ($split as $clef=>$vale) {
                if ($vale == 'r' || $vale == 'b' || $vale == 'g' || $vale == 'y' || $vale == 'p') {
                    $colours++;
                }
            }
        }

        $size = count($seed);
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
        echo "<div class='seed'>$seed</div>";
        $clear="clearr()";
        if($blue == true) $clear= $clear.";clearb()";
        if($purple == true) $clear= $clear.";clearp()";
        if($yellow == true) $clear= $clear.";cleary()";
        if($green == true) $clear= $clear.";clearg()";
        echo "<button id='reset' onclick='$clear'>reset</button>";

        if ($colours >= 2 && $tab[$colonne][$ligne] == 'g') {
            $green = true;

            echo "<script src='../js/red.js'></script>";

        } else if ($colours >= 4 && $tab[$colonne][$ligne] == 'y') {
            $yellow = true;

        } else if ($colours == 5 && $tab[$colonne][$ligne] == 'p') {
            $purple = true;
        }

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

    </div>
</main>


<footer>

</footer>

</body>