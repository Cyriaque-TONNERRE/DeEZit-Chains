<?php require './header.php'; ?>

<main>

    <?php
    include("connexion_db.php");
    if (isset($_SESSION["username"])) {
        $requete2 = "SELECT * FROM user where username='$_SESSION[username]'";
        $resultat2 = mysqli_query($connexion,$requete2);
        $row = mysqli_fetch_assoc($resultat2);
        if (isset($row["history_lvl"])) {
            $requete = "UPDATE user SET history_lvl=51 WHERE username='$_SESSION[username]'";
            $resultat = mysqli_query($connexion, $requete);
            if ($resultat == false) {
                echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
                die();
            }
        }
    }
    else {
        if (isset($_COOKIE["history_lvl"])) {
            setcookie("history_lvl", 51, time() + (365 * 24 * 3600));
        }
    }
    ?>

    <h1>Félicitation, tu as fini le mode aventure !</h1>
    <a href="history.php">Retour au menu</a>

</main>


<footer>

</footer>

</body>
