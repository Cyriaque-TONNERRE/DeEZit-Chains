<?php require './header.php';?>

<script>
    function setval(){
        storedValue = sessionStorage.getItem('tps');
        console.log(storedValue);
        document.cookie = `time=${storedValue}; expires=${new Date(new Date().getTime() + 4000000).toUTCString()}; path=/`;
    }
    setval();

</script>

<?php




if (isset($_COOKIE["time"])) {
    $time_left = $_COOKIE["time"];
    setcookie("time", "", time() - 3600, "/");
    unset($_COOKIE["time"]);
}
else{
    echo "<script>setval();</script>";
    if (isset($_COOKIE["time"])) {
        $time_left = $_COOKIE["time"];
        setcookie("time", "", time() - 3600, "/");
    
    }

}


    
function getScore($pseudo) {
    require './connexion_db.php';
    $requete = "SELECT current_time_trial FROM user WHERE username = '$pseudo'";
    $resultat = mysqli_query($connexion, $requete); //Executer la requete
    if ($resultat == FALSE) {
        echo "<p>Erreur d'exécution de la requete :" . mysqli_error($connexion) . "</p>";
        die();
    }
    $row = mysqli_fetch_assoc($resultat);
    mysqli_close($connexion);
    return $row["current_time_trial"];
}

function getBestScoreAll() {
    require './connexion_db.php';
    $requete = "SELECT time_trial FROM user WHERE time_trial = (SELECT MAX(time_trial) FROM user)";
    $resultat = mysqli_query($connexion, $requete); //Executer la requete
    if ($resultat == FALSE) {
        echo "<p>Erreur d'exécution de la requete :" . mysqli_error($connexion) . "</p>";
        die();
    }
    $row = mysqli_fetch_array($resultat);
    mysqli_close($connexion);
    return $row["time_trial"];
}





if (!(isset($_SESSION["username"]))) {
    header('Location: login.php');
}

else {
    $score = getScore($_SESSION["username"]);
    $pseudo = $_SESSION["username"];
    if (isset($_COOKIE["valid"])) {
        setcookie("valid", "", time() - 3600, "/");
        unset($_COOKIE["valid"]);
        require './connexion_db.php';
        $score = getScore($_SESSION["username"]);
        $score++;
        $requete = "UPDATE user SET current_time_trial = '$score' WHERE username = '$pseudo'";
        $resultat = mysqli_query($connexion, $requete); //Executer la requete
        mysqli_close($connexion);
        //header('Location: time.php');
        
    }
    if(!isset($time_left)){
        echo "<script>setval();</script>";
        //header('Location: time.php');
    }
    else if($time_left > 180 || $time_left <= 0){
        require './connexion_db.php';
        $requete = "UPDATE user SET current_time_trial = '0' WHERE username = '$pseudo'";
        $resultat = mysqli_query($connexion, $requete); //Executer la requete
        header('Location: index.php');
    }

}

?>

<main>
    <div id="minuteur"></div>
    <div id="score">Score : <?php echo $score; ?></div>
    <script>
        storedValue = sessionStorage.getItem('tps');
        console.log(storedValue);

        const FULL_DASH_ARRAY = storedValue*1.525;
        const WARNING_THRESHOLD = 90;
        const ALERT_THRESHOLD = 15;

        const COLOR_CODES = {
            info: {
                color: "green"
            },
            warning: {
                color: "orange",
                threshold: WARNING_THRESHOLD
            },
            alert: {
                color: "red",
                threshold: ALERT_THRESHOLD
            }
        };
        
        let TIME_LIMIT = sessionStorage.getItem('tps');

        let timePassed = 0;
        let timeLeft = TIME_LIMIT;
        let timerInterval = null;
        let remainingPathColor = COLOR_CODES.info.color;

        document.getElementById("minuteur").innerHTML = `
<div class="base-timer" id="timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="countdown" class="base-timer__label">
${formatTime(timeLeft)}
</span>
</div>
`;

        startTimer();

        
        function onTimesUp() {
            clearInterval(timerInterval);
            document.location.href="timescore.php";
        }

        function startTimer() {
            timerInterval = setInterval(() => {
                timePassed = timePassed += 1;
                timeLeft = TIME_LIMIT - timePassed;
                document.getElementById("countdown").innerHTML = formatTime(
                    timeLeft
                );
                setCircleDasharray();
                setRemainingPathColor(timeLeft);

                if (timeLeft === 0) {
                    onTimesUp();
                }
                //Ici il faudrait save la value et la reuse aprés, cela faciliterait les choses wlh
                sessionStorage.setItem('tps', timeLeft);
                storedValue = sessionStorage.getItem('tps');
                console.log(storedValue);
            }, 1000);
        }


        function formatTime(time) {
            let minutes = Math.floor(time / 60);
            let seconds = time % 60;

            if (seconds < 10) {
                seconds = `0${seconds}`;
            }
            if (minutes < 10){
                minutes = `0${minutes}`;
            }
            return `${minutes}:${seconds}`;
        }

        function setRemainingPathColor(timeLeft) {
            const {alert, warning, info} = COLOR_CODES;
            if (timeLeft <= alert.threshold) {
                document
                    .getElementById("base-timer-path-remaining")
                    .classList.remove(warning.color);
                document
                    .getElementById("base-timer-path-remaining")
                    .classList.add(alert.color);
            } else if (timeLeft <= warning.threshold) {
                document
                    .getElementById("base-timer-path-remaining")
                    .classList.remove(info.color);
                document
                    .getElementById("base-timer-path-remaining")
                    .classList.add(warning.color);
            }
        }

        function calculateTimeFraction() {
            const rawTimeFraction = timeLeft / TIME_LIMIT;
            return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
        }

        function setCircleDasharray() {
            const circleDasharray = `${(
                calculateTimeFraction() * FULL_DASH_ARRAY
            ).toFixed(0)} 283`;
            document
                .getElementById("base-timer-path-remaining")
                .setAttribute("stroke-dasharray", circleDasharray);
        }

    </script>


    <div class="game" id="game">
        <?php
        if (!(isset($_COOKIE['time_lvl']))) {
            setcookie("time_lvl", "0", 61000);
        }

        $tab = array();
        $green = false;
        $purple = false;
        $yellow = false;
        $blue = false;
        $bestScoreAll = getBestScoreAll();
        $id = "Niv".strval($score+1);
        $pseudo = $_SESSION["username"];
        if($score <= $bestScoreAll && $bestScoreAll!=0) { // Si le niveau existe deja dans level_time_trial.json
            $json = file_get_contents('../json/level_time_trial.json');
            $data = json_decode($json, false);
            $tab = $data->$id->level;
            $colours = 0;
            foreach ($tab as $cle=>$val) {
                $split =  str_split($val);
                foreach ($split as $clef=>$vale) {
                    if ($vale == 'r' || $vale == 'b' || $vale == 'g' || $vale == 'y' || $vale == 'p') {
                        $colours++;
                    }
                }
            }
        }

        else { // Sinon il faut creer un nouveau niveau
            require './connexion_db.php';
            $requete = "UPDATE user SET time_trial = '$score' WHERE username = '$pseudo'";
            $resultat = mysqli_query($connexion, $requete); //Executer la requete
            $seed = time();
            $colours = time()%5 + 1;
            if (DIRECTORY_SEPARATOR == '\\') {
                exec("randomGenerate.exe $seed $colours", $tab);
            } else {
                exec("chmod a+x ./randomGenerate");
                exec("./randomGenerate $seed $colours", $tab);
            }

            function fileWriteAppend($id,$pseudo,$tab,$score){ //fonction pour écrire dans le fichier json
                $current_data = file_get_contents('../json/level_time_trial.json');
                $array_data = json_decode($current_data, true);
                $extra = array(
                     'name' =>  'Level '.($score+1),
                     'author'   =>  $pseudo,
                     'level'    => $tab            
        
                );
                $array_data[$id] = $extra;
                $final_data = json_encode($array_data);
                return $final_data;
            }
            $final_data=fileWriteAppend($id,$pseudo,$tab,$score);
            if(file_put_contents('../json/level_time_trial.json', $final_data))
            {
                 $message = "<label class='text-success'>Data added Success fully</p>";
            }
            

        }
        $size = count($tab);
        $red = false;
        $green = false;
        $purple = false;
        $yellow = false;
        $blue = false;

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
        if (isset($seed)) {
            echo "<div class='seed'>$seed</div>";
        }
        $clear="clearr()";
        if($blue == true) $clear= $clear.";clearb()";
        if($purple == true) $clear= $clear.";clearp()";
        if($yellow == true) $clear= $clear.";cleary()";
        if($green == true) $clear= $clear.";clearg()";
        echo "<a onclick='back()' draggable='false' class='align-left' id='back'><image src='../image/arrow-left-solid.svg' draggable='false' id='arrow-light' alt='arrow'/></image> Back</a>";
        echo "<button id='reset' onclick='$clear'>Reset</button>";

        //A changer a cause de Cyriaque


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



            </body>