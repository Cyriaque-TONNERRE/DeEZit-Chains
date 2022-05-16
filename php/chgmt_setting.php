<?php
if (isset($_POST["theme"])) {
    setcookie("theme", $_POST["theme"], time() + (365 * 24 * 3600));
}
if (isset($_POST["sound"])) {
    setcookie("barsound", $_POST["sound"], time() + (365 * 24 * 3600));
    setcookie("sound", $_POST["sound"] / 100, time() + (365 * 24 * 3600));
}

header("Location: index.php");
?>
