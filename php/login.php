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
                    <h1>Login</h1>
                    <label for="username"></label >
                    <input class="input" type="text" name="username" id="username" placeholder="Username" required/>
                    <label for="password"></label >
                    <input class="input" type="password" name="password" id="password" placeholder="Password" required/>
                    <input class="input-button" type="submit" name="submit" id="submit" value="Login">
                    <a id="inscription" href="inscription.php">Not registered! Register here.</a>
                </div>
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