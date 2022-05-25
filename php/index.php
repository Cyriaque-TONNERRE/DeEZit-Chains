<?php require './header.php'; ?>

<main>

    <div class="button">
        <a draggable='false' class="gamemode" href="history.php">
            History Mode
        </a>
        <a draggable='false' class="gamemode" href="adventure.php">
            Adventure Mode
        </a>
        <a draggable='false' class="gamemode" href="time.php">
            Time Trial
        </a>
        <a draggable='false' class="gamemode" href="create.php">
            Creative Mode
        </a>
    </div>

    <script src="../js/confetti.min.js"></script>
    <script>
        let confetti = new Confetti('test');

        // Edit given parameters
        confetti.setCount(100);
        confetti.setSize(1.5);
        confetti.setPower(50);
        confetti.setFade(false);
        confetti.destroyTarget(false);
    </script>

</main>


<footer>

</footer>

</body>
</html>