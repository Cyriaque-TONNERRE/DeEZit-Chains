<?php require './header.php'; ?>

<main>

    <div>
        <nav class="formulaire">
            <form method="post" action="#">
                <fieldset>
                    <legend>Login :</legend>
                    <?php
                    if (isset($_COOKIE["ID"])) {
                        header("location:compte.php");
                    }
                    else {
                        echo '<label for="username">Username : </label >
                                <input type="text" name="username" id="username" value="" required/>
								<br><br>
								<label for="password">Password : </label >
								<input type="password" name="password" id="password" value="" required/>
								<br>
								<a id="inscription" href="inscription.php">Not registered! register here</a>
								<br><br>
								<input type="submit" name="submit" id="submit" value="Send"/>
								<input type="reset" value="Delete">';
                    }
                    ?>
                </fieldset>
            </form>
        </nav>
    </div>

</main>

<?php
include("connexion_db.php");
if (isset($_POST['submit'])){
    $username = $_POST["username"];
    $password = $_POST['password'];
    $requete = "select * from user where username='$username'"; //selectionner le mail, password, et ID de la table membre
    $resultat = mysqli_query($connexion,$requete);//executer la requete
    if ($resultat == FALSE) {
        echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
        die();
    }
    else {
        $row = mysqli_fetch_assoc($resultat);
        if (mysqli_num_rows($resultat) == 1 and password_verify($password,$row['password'])) {
            $_SESSION["username"] = $row["username"];
            header("location:index.php");
        }
        else{
            echo '<p class="error">Echec de connexion: identifiants incorrects</p>';
        }
    }
}
mysqli_close($connexion);




?>

<footer>

</footer>


</body>

</html>