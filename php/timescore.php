<?php require './header.php';
if(!(isset($_SESSION["username"]))){
    header('Location: login.php');
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
echo $score;
?>