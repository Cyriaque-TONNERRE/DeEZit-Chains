<!DOCTYPE html>

<html lang="fr">
<head>
    <title> DeEZit Chain </title>
    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">

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

        <div id="table">
            <?php
            for($j=0; $j < 4; $j++){
                echo "<div >";

            for ($i = 0; $i < 5;$i++) {
                $h = 5 * $i + $j + 1;
                echo "<div class='line$i' class='col$j'><a href='affichage_history.php?id=$h'>
                <input class ='btn' type='button' value='$h' /></a></div><br><br>";

            }
            echo "</div>";
            }
            ?>
        </div>

    </main>
	
	
    <footer> 
        
    </footer>
	
</body>
