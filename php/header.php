<!DOCTYPE html>

<html lang="fr">
<head>
    <title> DeEZit Chain </title>
    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/header.css">

</head>


<body>

<header>
    <?php

    if (!isset($_SESSION['connexion'])) {
        echo '
    <div class="connexion">
        <div class="logo">
            <img src="../image/test.gif" alt="logo">
        </div>
        <div class="titre">
            <h1> DeEZit Chain </h1>
        </div>
        <div class="login">
            <a href="login.php">
                <img src="../image/login.svg" alt="login">
            </a>
        </div>
    </div>';
    } else {
        echo '
    <div class="connected">
        <div class="logo">
            <img src="../image/test.gif" alt="logo">
        </div>
        <div class="titre">
            <h1> DeEZit Chain </h1>
        </div>
        <div class="register">
            <a href="login.php">
                <img src="../image/login.svg" alt="login">
            </a>
        </div>
    </div>';
    };

?>

</header>