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
        for ($i = 0; $i < 10; $i++) {

            for ($j = 0; $j < 5; $j++) {
                $num = 5 * $i + $j + 1;
                echo "<a class='line$i' class='col$j' href='affichage_history.php?id=$num'>
                <input class ='btn' type='button' value='$num' /></a><br><br>";

            }

        }
        ?>
    </div>

</main>


<footer>

</footer>

</body>
