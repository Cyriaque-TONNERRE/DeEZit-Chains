<?php require './header.php';
if (isset($_SESSION["username"])) {
    header("location:index.php");
}
?>

<main>
    <div>
        <nav class="formulaire">
            <form method="post" action="#">
                <div class="loginBox">
                    <h1 id="inscript_conf">Register</h1>
                    <label for="username"></label >
                    <input class="input" type="text" name="username" id="username" placeholder="Username" required/>
                    <label for="password"></label >
                    <input class="input" type="password" name="password" id="password" placeholder="Password" required/>
                    <input class="input-button" type="submit" name="submit" id="submit" value="Register">

                </div>
            </form>
        </nav>
    </div>
</main>

    <?php
    include("connexion_db.php");
    if(isset($_POST["submit"])) {
        $username = $_POST['username'];
        $requete = "SELECT * FROM user WHERE username='$username'";
        $resultat = mysqli_query($connexion,$requete);

        if ($resultat == FALSE) {
            echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
            die();
        }
        else {
            if(mysqli_num_rows($resultat) != 0) {
                echo "<p class='error'>There is already an account with this username.</p>";
            }
            else {
                $username = $_POST["username"];
                $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
                $requete = "INSERT INTO user(username,password) VALUES ('$username','$password')";
                $resultat = mysqli_query($connexion,$requete);
                if ($resultat == FALSE) {
                    echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
                    die();
                }
                else {
                    $requete = "SELECT * FROM user WHERE username='$username'";
                    $resultat = mysqli_query($connexion,$requete);
                    if ($resultat) {
                        $row = mysqli_fetch_assoc($resultat);
                        $_SESSION["username"] = $row["username"];
                        header("location:index.php");
                    }
                }   
            }
        }
    }
    mysqli_close($connexion);
    ?>


<footer>

</footer>


</body>


</html>