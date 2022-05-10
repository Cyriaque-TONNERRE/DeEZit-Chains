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
		
		<?php
			include("connexion_db.php");
			$requete = "select * from user where ID=".$_COOKIE[]['ID'];
			$resultat = mysqli_query($connexion,$requete);
			if ($resultat == FALSE) {
				echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
				die();
			}
			else {
				$row = mysqli_fetch_assoc($resultat);
			}
		?>
		
		<div>
			<nav class="formulaire">
				
			<form method="post" action="modifier.php">
				
				<fieldset>
					<legend>Account :</legend>
					<br>
					<label for="nom">Username :</label >
					<input type="text" name="username" id="username" value=<?php echo $row['username'];?> required/>
					<br><br>
					<label for="password">Password :</label >
					<input type="password" name="password" id="password" value="" required/>
					<br><br>
					<input type="submit" name="submit" id="submit" value="Submit"/>
					<input type="reset">
					<br><br>
					<button><a class="button" href="logout.php">Logout</a></button>
				</fieldset>
				
			</form>
				
			<?php		
				if(isset($_COOKIE["update"]) && $_COOKIE["update"] == 1) {
					echo '<p class="update">Updtated</p>' ;
					$_COOKIE["update"] = 0;
				}
			?>
				
			</nav>
		</div>	
			
	</main>
	
	
	<footer>
	
	</footer>    

</body>

</html>