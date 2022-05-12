<!DOCTYPE html>

<html lang="fr">
<head>
    <title> DeEZit Chain </title>
    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">
	<link rel="stylesheet" href="../css/test-js.css">
	
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
	
	<div class="case">
        <div class="base" draggable="true"></div>
    </div>

    <div class="case" id="1"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>
    <div class="case"></div>

    <script src="../js/test-js.js"></script>
		
	</main>
	
	
    <footer> 
        
    </footer>
	
</body>
