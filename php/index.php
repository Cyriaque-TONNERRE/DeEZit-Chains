<?php require './header.php'; ?>

<nav>
    <div class="menu">
        <?php
        if (isset($_SESSION["username"])) {
            echo "<a class='login' href='logout.php'>Logout</a>";
        }
        else {
            echo "<a class='login' href='login.php'>Login</a>";
        }
        ?>
    </div>
</nav>


<main>

    <div>
        <a id="history" class="gamemode" href="history.php">History Mode</a><br>
        <a id="adventure" class="gamemode" href="adventure.php">Adventure Mode</a><br>
        <a id="time" class="gamemode" href="time.php">Time Trial</a><br>
        <a id="creative" class="gamemode" href="creative.php">Creative Mode</a><br>
    </div>

</main>


<footer>

</footer>

</body>
