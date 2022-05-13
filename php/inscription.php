<!DOCTYPE html>

<html lang="fr">
<head>
    <title> DeEZit Chain </title>
    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/login.css">
</head>


<body>

<header>
    <?php require './header.php'; ?>
</header>


<main>

    <div>
        <nav class="formulaire">
            <form method="post" action="#">
                <fieldset>
                    <legend>Register :</legend>
                    <br>
                    <label for="username">Username :</label >
                    <input type="text" name="username" id="username" value="" required/>
                    <br><br>
                    <label for="password">Password :</label >
                    <input type="password" name="password" id="password" value="" required/>
                    <br><br>
                    <input type="submit" name="submit" id="submit" value="Submit"/>
                    <input type="reset" value="Delete">
                </fieldset>
            </form>
        </nav>
    </div>

    <?php
    include("connexion_db.php");
    if(isset($_POST["submit"])) {
        $username = $_POST['username'];
        $requete = "SELECT * FROM user WHERE username='$username'";
        $resultat = mysqli_query($connexion,$requete);

        if ($resultat == FALSE){
            echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
            die();
        }
        else {
            if(mysqli_num_rows($resultat) != 0) {
                echo "<p class='error'>There is already an account with this username.</p>";
                echo '<a href="login.php">Login</a>';
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

</main>


<footer>

</footer>


</body>


</html>