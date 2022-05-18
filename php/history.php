<?php require './header.php'; ?>

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
