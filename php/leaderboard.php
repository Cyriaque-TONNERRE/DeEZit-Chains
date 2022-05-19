<?php require './header.php'; ?>


<head>
    <title>Live Search using AJAX</title>
    <!-- Including jQuery is required. -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Including our scripting file. -->
    <script type="text/javascript" src="../js/script.js"></script>
    <!-- Including CSS file. -->
    <link rel="stylesheet" src="../css/leaderboard.css"

</head>
<body>
<!-- Search box. -->
<input type="text" id="search" placeholder="Search" />

<!-- Suggestions will be displayed in below div. -->
<div id="display"></div>
</body>
<main>

    <div>
        <table><tr><h1>Leaderboard</h1></tr> </h1>

            <?php
            include("connexion_db.php");
            $requete = "SELECT username,adventure_lvl,time_trial FROM user ORDER BY adventure_lvl DESC, time_trial ASC, username ASC limit 100";
            $resultat = mysqli_query($connexion, $requete); //Executer la requete
            if ($resultat == FALSE) {
                echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
                die();
            }

                //essaie d'ajout pour voir son classement dans le leaderboard (toutes les modifs en 2)
                //$requete2 = "SELECT username,adventure_lvl,time_trial from user where username=$_SESSION['username']";
                //$resultat2= mysqli_query($connexion, $requete2); //Executer la requete


            else {
                echo "<tr>
						<th>Rank</th>
						<th>Username</th>
						<th>Level</th>
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
                                echo "<td class='active rank$i'>$row[adventure_lvl]</td>";
                                echo "<td class='active rank$i'>$row[time_trial]</td>";
                            }
                            else{
                                    echo "<td class='rank$i'>$i</td>";
                                    echo "<td class='rank$i'>$row[username]</td>";
                                    echo "<td class='rank$i'>$row[adventure_lvl]</td>";
                                    echo "<td class='rank$i'>$row[time_trial]</td>";}
                            }

                            else{
                                    echo "<td class='rank$i'>$i</td>";
                                    echo "<td class='rank$i'>$row[username]</td>";
                                    echo "<td class='rank$i'>$row[adventure_lvl]</td>";
                                    echo "<td class='rank$i'>$row[time_trial]</td>";}
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


<footer>

</footer>


