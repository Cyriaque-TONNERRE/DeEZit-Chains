<?php session_start();
$array = explode('/', $_SERVER['PHP_SELF']);
$nom = explode('.', end($array))[0];?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title> DeEZit Chain </title>

    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/header.css">
    <?php echo "<link rel='stylesheet' href='../css/$nom.css'>" ?>
    <?php
    if (isset($_COOKIE["theme"])) {	//si le cookie existe
        $theme = $_COOKIE["theme"];	//on récupère le theme choisi enregistré dans le cookie
    }
    else{
        $theme = "white";
    }
    ?>
    <?php echo "<link rel='stylesheet' href ='../css/$theme.css'/>" ?>



</head>


<body>

<header>
    <div class="header">
        <div class="logo">
            <img src="../image/test.gif" alt="logo">
        </div>
        <div class="titre">
            <h1> DeEZit Chain </h1>
        </div>
        <?php if(isset($_SESSION['username'])) { echo
        "<div class='login'>
            <img src='../image/login.svg' alt='login'>
            <div class='pop-up'>
                Bonjour ".$_SESSION['username']."
                <br />
                <a href='logout.php'>Se déconnecter</a>
            </div>
        </div>";
        } else { echo "
        <div class='login'>
            <a href='login.php'>
                <img src='../image/login.svg' alt='login'>
            </a>
        </div>";
        }
        ?>

        <div class="setting">
            <a href="setting.php">
                <img src="../image/setting.svg" alt="setting">
            </a>
        </div>
    </div>
</header>