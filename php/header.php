<?php session_start();?>
<!DOCTYPE html>

<html lang="fr">
<head>
    <title> DeEZit Chain </title>
    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/header.css">
    <?php
    if (isset($_COOKIE["theme"])) {	//si le cookie existe
        $theme = $_COOKIE["theme"];	//on récupère le theme choisi enregistré dans le cookie
    }
    else{
        $theme = "white";
    }
    ?>
    <link rel="stylesheet" href ="css/<?php echo $theme; ?>.css"/>

</head>


<body>

<header>

    <div class="connexion">
        <div class="logo">
            <img src="../image/test.gif" alt="logo">
        </div>
        <div class="titre">
            <h1> DeEZit Chain </h1>
        </div>
        <?php
        if (!isset($_SESSION['username'])) {
            echo '<div class="poubelle"></div>';
        }
        ?>
        <div class="login">
            <a href="login.php">
                <img src="../image/login.svg" alt="login">
            </a>
        </div>
        <?php
        if (isset($_SESSION['username'])) {
            echo '<div class="setting">
                    <a href="setting.php">
                        <img src="../image/setting.svg" alt="setting">
                    </a>
                </div>';
        }
        ?>
    </div>

</header>