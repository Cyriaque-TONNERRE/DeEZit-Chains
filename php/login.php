<!DOCTYPE html>

<html lang="fr">
<head>
    <title> DeEZit Chain </title>
    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">
</head>


<body>
	
    <header>
		
    </header>
			
	
	<main>
		
		<div>
			<nav class="formulaire">
				
				<form method="post" action="#">
					<?php
						if (isset($_COOKIE["ID"])) {
							header("location:compte.php");
						}
						else {
							echo '<label for="usernamehg">Username : </label >
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
				<nav class="formulaire">
				
			<form method="post" action="#">
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
			if (mysqli_num_rows($resultat) == 1 and password_verify($password,$row['Password'])) {
				setcookie("usermane",$row['username'],time()+365*24*3600);
				header("location:index.php");
			}
			else{
				echo '<p class="error">Echec de connexion: identifiants incorrects</p>';
			}
		}
	}
	mysqli_close($connexion);
	
	
	

?>		
		
   <footer> <!-- On place dans cette balise le contenue du pied de page -->
	   	
	</footer>    
  

</body>


</html>