<?php
include("connexion_db.php");
if ($connexion) {
	if (isset($_POST["submit"])){
		$username = $_POST["username"];
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT); 	
		$requete = "UPDATE user SET username='$username', password='$password' WHERE username=$username";
		$resultat = mysqli_query($connexion, $requete); //Executer la requete
		if ($resultat == FALSE) {
			echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>";
			die();
		}
		else {			
			$_SESSION["update"] = 1;
				header("location:compte.php");
				mysqli_close($connexion); //Fermer la connexion
		}
	}
}
?>