<?php require './header.php';
?>



<head>
    <title>Live Search using AJAX</title>
    <!-- Including jQuery is required. -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Including our scripting file. -->
    <script type="text/javascript" src="../js/script.js"></script>
    <!-- Including CSS file. -->
    <link rel="stylesheet" href="../css/leaderboard.css"/>


</head>

<main>
<body>
<div class="button">
    <a draggable='false' class="gamemode" href="leaderboard_aventure.php">
        Adventure Mode
        <img src="../image/Adventurer_Hat.svg" alt="Adventurer hat" id="hat"/>
    </a>
    <a draggable='false' class="gamemode2" href="leaderboard_time_trial.php">
        Time Trial
        <img src="../image/clock.svg" alt="clock" id="clock"/>
    </a>
</div>

</body>
</main>


