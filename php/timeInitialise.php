<?php
session_start();
if (!(isset($_SESSION["username"]))) {
    header('Location: login.php');
}
else{
    require './connexion_db.php';
    $pseudo = $_SESSION["username"];
    $requete = "UPDATE user SET current_time_trial = '0' WHERE username = '$pseudo'";
    $resultat = mysqli_query($connexion, $requete); //Executer la requete
    header('Location: time.php');
}

?>