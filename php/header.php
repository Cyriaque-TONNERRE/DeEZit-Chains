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
    <?php
    if (isset($_COOKIE["theme"])) {	//si le cookie existe
        if ($_COOKIE["theme"] == "dark") {	//si le cookie est égal à dark
            echo "<link rel='stylesheet' href='../css/dark_header.css' id='header_theme'>";
            echo "<link rel='stylesheet' href='../css/dark_$nom.css' id='body_theme'>";
        } else {
            echo "<link rel='stylesheet' href='../css/header.css' id='header_theme'>";
            echo "<link rel='stylesheet' href='../css/$nom.css' id='body_theme'>";
        }
    } else {
        echo "<link rel='stylesheet' href='../css/header.css' id='header_theme'>";
        echo "<link rel='stylesheet' href='../css/$nom.css' id='body_theme'>";
    }

    ?>



</head>


<body>

<audio id="bgsound" autoplay loop hidden>
    <source src="../sound/LANETROTRO.mp3">
    Your browser does not support the audio
</audio>

<script>
    function getCookie(cookieName) {
        const name = cookieName + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            const c = ca[i].trim();
            if ((c.indexOf(name)) === 0) {
                console.log('found')
                return c.substr(name.length);
            }

        }
        console.log('not found')
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
        console.log(document.getElementById('bgsound').currentTime);
        console.log(document.cookie);
    })

</script>

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