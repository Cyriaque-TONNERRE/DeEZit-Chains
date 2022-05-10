<!DOCTYPE html>

<html lang="fr">
<head>
    <title> BIJOUTERIE LAMBERT </title>
    <meta name="description" content="Nous allons recreer le site d'une bijouterie">
    <meta name="keywords" content="Bijoux, Montres, Alliances">
    <meta name="author" content="Edouard LAMBERT et Lancelot HUBY">
    <meta charset="UTF-8">
	<link rel="stylesheet" href="css/contact.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php
	if (isset($_COOKIE["theme"])){	//si le cookie existe
			$style=$_COOKIE["theme"];	//on récupère le theme choisi enregistré dans le cookie
		}
		else{
			$style="White";
		}	
	?>
	<link rel="stylesheet" href ="css/<?php echo $style; ?>.css"/>
	<?php include("maj_session.php");?>
</head>


<body>
	
    <header> <!-- On place dans cette balise le contenue de l'en-tête -->
		
		<div class="Entete">
			
			<img src="images/Bijouterie_Lambert_Calais.jpg" id="bijcal" alt="Bijouterie Calais"/>
			<h1 id="Titre"> Bijouterie Lambert </h1> <!-- On affiche le nom de l'entreprise en tant que titre très important -->
			<h2 id="Devise"> "Elle a tout pour plaire la Bijouterie Lambert !" </h2> <!-- On affiche la devise de l'entreprise en tant que titre moins important que celui du dessus -->
			<img src="images/Bijouterie_Lambert_Boulogne.jpg" id="bijboul" alt="Bijouterie Boulogne"/>
			
		</div>
		
    </header>

		
	<nav> <!-- On place dans cette balise le menu permettant de passer d'une page à une autre -->
			
		<ul class="Menu">

       		<li><a href="index.php" id="accueil">ACCUEIL</a></li>
			<li><a href="montres.php" id="montres">MONTRES</a></li>
           	<li><a href="bijoux.php" id="bijoux">BIJOUX</a></li>
           	<li><a href="alliances.php" id="alliances">ALLIANCES</a></li>
			<li><a href="bijouxregionaux.php" id="bijreg">BIJOUX REGIONAUX</a></li>
			<li><a class="active" href="login.php" id="connexion">COMPTE</a></li>
			<li><a href="panier.php" id="shop"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
		</ul>
		<br>
	</nav>
		
		
		
		
	
	<main> <!-- On place dans cette balise le contenue de la page "contact" -->
		
		<div>
			
			<nav class="formulaire">
				
			<form method="post" action="#">
			
				<fieldset> <!-- Cette balise contient la première case de contact dans laquelle l'utilisateur peut donner ses informations personnelles -->
				
					<legend>Inscription :</legend>
					<br>
					<label>Genre:</label>
					<input type="radio" name="genre" id="Feminin" value="Feminin" required>
					<label for="mme">Madame</label>
					<input type="radio" name="genre" id="Masculin" value="Masculin" required>
					<label for="mr">Monsieur</label>
		
					<br><br>
			
					<label for="nom">Nom :</label >
					<input type="text" name="nom" id="nom" value="" required />
					<br><br>
		
					<label for="prenom">Prénom :</label >
					<input type="text" name="prenom" id="prenom" value="" required />
					<br><br>
					
					<label for="courriel">Courriel : </label >
					<input type="email" name="courriel" id="courriel" value="" required />
					<br><br>
					
					<label for="password">Mot de passe :</label >
					<input type="password" name="password" id="password" value="" required />
					<br><br>
		
					<input type="submit" name="soumission" id="soumission" value="Envoyer"/>
					<input type="reset">
					
				</fieldset>
					
			</form>
				
			</nav>
			
		</div>	
		
		<?php
			include("connexion_db.php");
			if(isset($_POST["soumission"])){
				$courriel=$_POST['courriel'];
				$requete="select * from membres where Courriel='$courriel'";
				$resultat=mysqli_query($connexion,$requete);
				
				if ( $resultat == FALSE ){
					echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
					die();
				}
				else{
					if(mysqli_num_rows($resultat)!=0){
						echo "<p class='error'> Vous êtes déjà inscrit avec cette adresse mail.</p>";
						echo '<a href="login.php">Connexion</a>';
					}
					else{
						$nom=$_POST["nom"];$prenom=$_POST["prenom"];$genre=$_POST["genre"];$courriel=$_POST["courriel"];$password=password_hash($_POST["password"],PASSWORD_DEFAULT);
						$requete="insert into membres values (NULL,'$nom','$prenom','$genre','$courriel','$password','Client')";
						$resultat=mysqli_query($connexion,$requete);
						if ( $resultat == FALSE ){
							echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
							die();
						}else{
							$requete="select ID,Admin from membres where Courriel='$courriel'";
							$resultat=mysqli_query($connexion,$requete);
							if($resultat){
								$row=mysqli_fetch_assoc($resultat);
								$_SESSION['ID']=$row['ID'];
								$_SESSION['admin']=$row['Admin'];
								header("location:index.php");
							}
							
						}
					}
				}
			}
			mysqli_close($connexion);
		
		?>
			
	</main>
		
		

		
		
   <footer> <!-- On place dans cette balise le contenue du pied de page -->
	   
	   <div class="Piedpage"> <!-- Nous utilisons une grid pour la présentation du footer, nous placons chaque element dans un div pour y voir le plus clair possible et nous donnons à chaque div une class -->
		   
		   <div class="Calais1">
		   
				<h2>Calais</h2>
	            <p>23 Boulevard la Fayette<br> 62100 - Calais</p>
	            <p><a class="tel" href="#"> <i class="fa fa-phone" aria-hidden="true"></i>&nbsp; 03.21.30.89.13</a><br> <!-- Nous n'avons pas demandé l'autorisation pour appeler la bijouterie depuis notre projet, nous n'avons donc pas mis de liens direct. -->
				<a href="contact.php"> <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; Contactez-nous !</a></p>
			    <p><a id="facebook" href="https://www.facebook.com/bijouterielambertcalaisboulogne/"> <i class="fa fa-facebook" aria-hidden="true"></i>&nbsp; Facebook</a></p>
			   
		   </div>
		   
		   
		   <div class="Calais2"> <!-- Cette div ne sert qu'à afficher une ligne de séparation du contenue -->
			   
		   		<hr>
		   
		   </div>
		  
	
		   <div class="Calais3">
			
			   <p><i class="fa fa-clock-o" aria-hidden="true"></i> <strong>Ouvert</strong> de 10h00 à 12h00 et de 14h00 à 19h00.<br>
			   <strong>Fermé le Lundi matin et le Dimanche.</strong></p>   
	  
		   </div>
	   
		
		   <div class="GMCalais"> <!-- Cette balise permet d'afficher une image google map sur laquelle nous pouvons intéragir -->
		   
			   <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d20109.169037235464!2d1.8569873254089186!3d50.94875708796801!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7c83d71c4663f8a4!2sBijouterie+Lambert!5e0!3m2!1sfr!2sfr!4v1533736144632" ></iframe>
	   
		   </div>
	   
	   
		   <div class="Boulogne1">
		   
			   <h2>Boulogne sur Mer</h2>
			   <p>40 Rue Adolphe Thiers<br> 62200 - Boulogne-sur-Mer</p>
			   <p><a class="tel" href="#"> <i class="fa fa-phone" aria-hidden="true"></i>&nbsp; 03.21.36.61.78</a><br> <!-- Nous n'avons pas demandé l'autorisation pour appeler la bijouterie depuis notre projet, nous n'avons donc pas mis de liens direct. -->
			   <a href="contact.php"> <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; Contactez-nous !</a></p>
			   <p><a id="instagram" href="https://www.instagram.com/bij.lambert/"> <i class="fa fa-instagram" aria-hidden="true"></i>&nbsp; Instagram</a></p>
			   
		   </div>
		   
		   
		   <div class="Boulogne2"> <!-- Cette div ne sert qu'à afficher une ligne de séparation du contenue -->
			   
		   		<hr>
		   
		   </div>
		   
	   
		   <div class="Boulogne3">
		   
			   <p><i class="fa fa-clock-o" aria-hidden="true"></i><strong> Ouvert</strong> de 10h00 à 12h00 et de 14h00 à 19h00.<br>
			   <strong>Fermé le Lundi et le Dimanche.</strong></p>
	  
		   </div>
		
	   
		   <div class="GMBoulogne"> <!-- Cette balise permet d'afficher une image google map sur laquelle nous pouvons intéragir -->
		   
			   <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10103.083026078446!2d1.6052889!3d50.724192!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9cd20522f5d33786!2sBijouterie+Lambert!5e0!3m2!1sfr!2sfr!4v1528444595747"></iframe>
		   
		   </div>
		   
	   </div>
		   
	
	</footer>    
  

</body>


</html>