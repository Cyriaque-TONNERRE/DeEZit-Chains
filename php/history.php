<!DOCTYPE html>

<html lang="fr">
<head>
    <title> DeEZit Chain </title>
    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/index.css">
	<link rel="stylesheet" href="../css/history.css"/>
</head>
	
<body>
	
    <header>

		
    </header>

    <nav>

        <?php
        if (isset($_COOKIE["username"])) {
            echo "<a href='logout.php'>Logout</a>";
        }
        else {
            echo "<a href='login.php'>Login</a>";
        }
        ?>

    </nav>

    <main>

        <div>
            <?php
            for ($i = 1; $i <= 20;$i++) {
                echo "<a id='$i' class='level' href='affichage_history.php?id=$i'>$i</a><br>";
            }
            ?>
        </div>

    </main>
	
	
    <footer> 
        
    </footer>
	
</body>
