<?php
if (isset($_POST["theme"])) {
    setcookie("theme", $_POST["theme"], time() + (365 * 24 * 3600));
}
if (isset($_POST["sound"])) {
    setcookie("sound", $_POST["sound"], time() + (365 * 24 * 3600));
}

header("Location: index.php");
?>
