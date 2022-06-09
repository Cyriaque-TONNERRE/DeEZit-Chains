<?php require './header.php';
if(!(isset($_SESSION["username"]))){
    header('Location: login.php');
}

function getScore($pseudo){
    require './connexion_db.php';
    $requete = "SELECT current_time_trial FROM user WHERE username = '$_SESSION[username]'";
    $resultat = mysqli_query($connexion, $requete); //Executer la requete
    if ($resultat == FALSE) {
        echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
        die();
    }
    $row = mysqli_fetch_assoc($resultat);
    return $row["current_time_trial"];
}

function getBestScore($pseudo){
    require './connexion_db.php';
    $requete = "SELECT time_trial FROM user WHERE username = '$_SESSION[username]'";
    $resultat = mysqli_query($connexion, $requete); //Executer la requete
    if ($resultat == FALSE) {
        echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
        die();
    }
    $row = mysqli_fetch_assoc($resultat);
    return $row["time_trial"];
}

$score = getScore($_SESSION["username"]);
$bestscore = getBestScore($_SESSION["username"]);

if ($score <= $bestscore) {
    echo "<p>Your score : $score</p>";
}

if ($score > $bestscore) { // New record
    echo "<p>New record : $score</p>";
    // On remplace le meilleur score
    require './connexion_db.php';
    $requete = "UPDATE user SET time_trial = '$score' WHERE username = '$_SESSION[username]'";
    $resultat = mysqli_query($connexion, $requete); //Executer la requete
}

echo "<a href='./leaderboard_time_trial.php' class='lead'>Check the leaderboard</a>";

// On remet a 0 le score actuel pour la prochaine partie
require './connexion_db.php';
$requete = "UPDATE user SET current_time_trial = '0' WHERE username = '$_SESSION[username]'";
$resultat = mysqli_query($connexion, $requete); //Executer la requete
?>