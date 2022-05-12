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
        <?php
        $id = $_GET["id"];
        ?>
        <script>
            const level = localStorage.getItem("level");
            const

        </script>
	</main>
	
	
    <footer> 
        
    </footer>
	
</body>
