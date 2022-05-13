<?php
if (isset($_POST["theme"])) {
    if($_POST["theme"] == "white") {
        setcookie("theme", "white", time() + (365 * 24 * 3600));
    }
    else {
        setcookie("theme", "dark", time() + (365 * 24 * 3600));
    }
}
header("Location: index.php");
?>
