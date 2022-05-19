<?php require './header.php'; ?>

<main>
    <aside>
        <div>
            <table><tr><th><h1>Leaderboard</h1></th></tr> </h1>

                <?php
                require './connexion_db.php';
                if ($connexion) {
                    $requete = "SELECT username,history_lvl,time_trial from user ORDER BY 2 DESC limit 5";
                    $resultat = mysqli_query($connexion, $requete); //Executer la requete

                    //essaie d'ajout pour voir son classement dans le leaderboard (toutes les modifs en 2)
                    //$requete2 = "SELECT username,adventure_lvl,time_trial from user where username=$_SESSION['username']";
                    //$resultat2= mysqli_query($connexion, $requete2); //Executer la requete
                }
                if ($resultat == FALSE) {
                    echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
                    die();
                }
                else {
                    $nbreLignes = mysqli_num_rows($resultat); //Nombre de ligne du retour de la requete
                    if ($nbreLignes > 0) {
                        while ($row = mysqli_fetch_assoc($resultat)) {
                            echo "<tr>";
                            foreach ($row as $colonne) {
                                echo "<td>$colonne</td>";
                            }

                            //$nbreLigne2 = mysqli_num_rows($resultat2); //Nombre de ligne du retour de la requete
                            //if ($nbreLigne2 > 0) {
                            //while ($row2 = mysqli_fetch_assoc($resultat2)) {
                            //echo "<tr>";
                            //foreach ($row2 as $colonne2) {
                            //echo "<td>$colonne2</td>";
                            //}

                            //}
                        }
                        echo "</table>";
                        mysqli_close($connexion); //Fermer la connexion
                    }
                }

                ?>
        </div>
    </aside>
</main>


<footer>

</footer>

</body>
