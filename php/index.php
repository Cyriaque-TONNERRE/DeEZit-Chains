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
	
    </header>
	
	
	<nav>
		<div class="menu">
			<?php
			if (isset($_COOKIE["username"])) {
				echo "<a class='login' href='logout.php'>Logout</a>";
			}
			else {
				echo "<a class='login' href='login.php'>Login</a>";
			}
			?>
		</div>
	</nav>
	
	
    <main>
		
		<div>
			<a class="gamemode" href="history.php">History Mode</a><br>
			<a class="gamemode" href="adventure.php">Adventure Mode</a><br>
			<a class="gamemode" href="time.php">Time Trial</a><br>
			<a class="gamemode" href="creative.php">Creative Mode</a><br>
		</div>
    
	</main>
	
	
    <footer> 
        
    </footer>
	
</body>
