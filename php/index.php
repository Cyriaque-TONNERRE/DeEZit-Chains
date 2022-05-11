<!DOCTYPE html>

<html lang="fr">
<head>
    <title> DeEZit Chain </title>
    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">
	<link rel="stylesheet" href="../css/index.css">
	
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
		
		<a class="gamemode" href="history.php">History Mode</a><br>
		<a class="gamemode" href="#">Adventure Mode</a><br>
		<a class="gamemode" href="#">Time Trial</a><br>
		<a class="gamemode" href="#">Creative Mode</a><br>
    
	</main>
	
	
    <footer> 
        
    </footer>
	
</body>
