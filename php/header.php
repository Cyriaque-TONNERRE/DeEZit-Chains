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
    <link rel="stylesheet" href="../css/header.css" id="header_theme">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <script src="https://kit.fontawesome.com/5f5041c2bc.js" crossorigin="anonymous"></script>
    <?php
    if (isset($_COOKIE["theme"])) {	//si le cookie existe
        if ($_COOKIE["theme"] == "dark") {	//si le cookie est égal à dark
            echo "<link rel='stylesheet' href='../css/dark_header.css' id='header_theme'>";
            echo "<link rel='stylesheet' href='../css/dark_index.css' id='body_theme'>";
            echo "<link rel='stylesheet' href='../css/dark_login.css' id='login_theme'>";
            echo "<link rel='stylesheet' href='../css/dark_leaderboard.css' id='leaderboard_theme'>";
        } else {
            echo "<link rel='stylesheet' href='../css/header.css' id='header_theme'>";
            echo "<link rel='stylesheet' href='../css/$nom.css' id='body_theme'>";
            echo "<link rel='stylesheet' href='../css/login.css' id ='login_theme'>";
            echo "<link rel='stylesheet' href='../css/leaderboard.css' id='leaderboard_theme'>";
        }
    } else {
        echo "<link rel='stylesheet' href='../css/header.css' id='header_theme'>";
        echo "<link rel='stylesheet' href='../css/$nom.css' id='body_theme'>";
        echo "<link rel='stylesheet' href='../css/login.css' id ='login_theme'>";

    }

    ?>

</head>


<body>
<audio id="bgsound" autoplay loop hidden>
    <source src="../sound/LANETROTRO.mp3">
    Your browser does not support the audio
</audio>

<script>
    setVolume();
    function getCookie(cookieName) {
        const name = cookieName + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            const c = ca[i].trim();
            if ((c.indexOf(name)) === 0) {
                return c.substr(name.length);
            }

        }
        return null;
    }

    currenTime = getCookie('currentTime');
    if (currenTime !== null) {
        console.log('recorded time: ' + currenTime);
        document.getElementById('bgsound').currentTime = currenTime;
    }

    function setVolume() {
        const monElementAudio = document.getElementById('bgsound');
        monElementAudio.volume = getCookie('volume');
    }

    addEventListener('click', event => {
        //enregistrer monElementAudio.currentTime dans un cookie
        document.cookie = `currentTime=${document.getElementById('bgsound').currentTime}; expires=${new Date(new Date().getTime() + 31536000000).toUTCString()}; path=/`;
    })

</script>

<header>
    <div class="header">
        <div class="logo">
            <a draggable="false" href="index.php"><img draggable="false" src="../image/test.gif" alt="logo"></a>
        </div>

        <div class="center-txt">

        </div>
        <div class="titre">
            <h1 id="test"> DeEZit Chain </h1>
        </div>
        <div class="classement">
            <a draggable="false" href="leaderboard.php"><img draggable="false" src="../image/trophy.svg" alt="trophy"></a>
        </div>
        <?php if(isset($_SESSION['username'])) { echo
        "<div class='login'>
            <img draggable='false' src='../image/login.svg' alt='login'>
            <div class='pop-up'>
                Bonjour ".$_SESSION['username']."
                <br />
                <a draggable='false' href='logout.php'>Se déconnecter</a>
            </div>
        </div>";
        } else { echo "
        <div class='login'>
            <a draggable='false' href='login.php'>
                <img draggable='false' src='../image/login.svg' alt='login'>
            </a>
        </div>";
        }
        ?>

        <div class="setting">
            <a draggable='false' href="setting.php">
                <img draggable='false' src="../image/setting.svg" alt="setting">
            </a>
        </div>
    </div>
</header>
