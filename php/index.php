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

		<?php
		if (isset($_COOKIE["username"])) {
			echo "<a href='logout.php'>Logout</a>";
		}
		else {
			echo "<a href='login.php'>Login</a>";
		}
		?>
		
    </header>
	
	
    <main>
		
		<a href="#">History Mode</a>
		<a href="#">Adventure Mode</a>
		<a href="#">Time Trial</a>
		<a href="#">Creative Mode</a>
    
	</main>
	
	
    <footer> 
        
    </footer>
	
</body>
