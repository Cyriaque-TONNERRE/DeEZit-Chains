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
        $id = "Niv".$_GET["id"];
        echo $id."<br>";
        $json = file_get_contents('../level.json');
        $data = json_decode($json, false);
        foreach ($data->$id->level as $cle=>$val) {
            echo " ".$val."<br>";
        }
        ?>
        
        <?php
        $green = false;
        $purple = false;
        $yellow = false;
        $blue = false;
        $size = count($data->$id->level);
        echo $size;
        ?>

    </main>
	
	
    <footer> 
        
    </footer>
	
</body>
