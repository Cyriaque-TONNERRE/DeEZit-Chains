<?php require './header.php'; ?>

<main>

    <div id="table">
        <?php
        for ($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $num = 5 * $i + $j + 1;
                if (isset($_SESSION["username"])) {
                    include("connexion_db.php");
                    $username = $_SESSION["username"];
                    $requete = "SELECT history_lvl FROM user WHERE username='$username'";
                    $resultat = mysqli_query($connexion,$requete);
                    if ($resultat == FALSE) {
                        echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
                        die();
                    }
                    else {
                        $row = mysqli_fetch_assoc($resultat);
                        if (mysqli_num_rows($resultat) == 1 && $num <= $row["history_lvl"]) {
                            if ($num == $row["history_lvl"]) {
                                echo "<a class='btn' class='line$i' class='col$j' href='affichage_history.php?id=$num'>$num</a>";
                            }
                            else {
                                echo "<a class='btn_done' class='line$i' class='col$j' href='affichage_history.php?id=$num'>$num</a>";
                            }
                        }
                        else {
                            echo "<p class='btn_close' class='line$i' class='col$j' href='affichage_history.php?id=$num'>$num</p>";
                        }
                    }

                }
                else {
                    if (isset($_COOKIE["history_lvl"])) {

                    }
                }
            }
        }
        ?>
    </div>

</main>


<footer>

</footer>

</body>
