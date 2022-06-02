<?php require './header.php';
?>

<head>
    <title>Leaderboard</title>

</head>
<main>

    <div>
        <div id="wrapper">
        <a href='leaderboard.php' class='back align-left'><i class='fa-solid fa-arrow-left'></i> Back</a>
        <h2 class="align-center">Leaderboard</h2>
        <br>
        <h4 class="align-center">TOP PLAYER OF TIME TRIAL MODE</h4>
        </div>
        <?php
        include("connexion_db.php");
        $requete = "SELECT username,time_trial FROM user ORDER BY time_trial ASC, username ASC limit 8";
        $resultat = mysqli_query($connexion, $requete); //Executer la requete
        if ($resultat == FALSE) {
            echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
            die();
        }

        //essaie d'ajout pour voir son classement dans le leaderboard (toutes les modifs en 2)
        //$requete2 = "SELECT username,adventure_lvl,time_trial from user where username=$_SESSION['username']";
        //$resultat2= mysqli_query($connexion, $requete2); //Executer la requete


        else {

            echo "<img src='../image/podium.svg' id='podium' alt='podium' draggable='false'/>";
            echo "<table><tr>
						<th>Rank</th>
						<th>Username</th>
						<th>Time Trial</th>
					</tr>";
            $nbreLignes = mysqli_num_rows($resultat); //Nombre de ligne du retour de la requete
            $i=0;
            if ($nbreLignes > 0) {
                while ($row = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    $i += 1;
                    if (isset($_SESSION['username'])){
                        if ($row['username'] == $_SESSION['username']) {
                            echo "<td class='active rank$i'>$i</td>";
                            echo "<td class='active rank$i'>$row[username]</td>";
                            echo "<td class='active rank$i'>$row[time_trial]</td>";

                        }
                        else{
                            echo "<td class='rank$i'>$i</td>";
                            echo "<td class='rank$i'>$row[username]</td>";
                            echo "<td class='rank$i'>$row[time_trial]</td>";
                        }
                    }

                    else{
                        echo "<td class='rank$i'>$i</td>";
                        echo "<td class='rank$i'>$row[username]</td>";
                        echo "<td class='rank$i'>$row[time_trial]</td>";
                    }
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
        }
        echo "</table>";
        mysqli_close($connexion); //Fermer la connexion



        ?>
    </div>

</main>