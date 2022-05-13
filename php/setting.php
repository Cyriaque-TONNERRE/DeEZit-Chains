<?php require './header.php'; ?>

<main>
    <form method="post" action="chgmt_setting.php">
        <fieldset>
            <legend>SETTINGS</legend>
            <label>Theme :</label>
            <?php
            if (isset($_COOKIE["theme"])) {
                if ($_COOKIE['theme'] == "dark") {
                    echo "<input type='radio' name='theme' value='white'/>
                        <label for='white'>White Theme</label>
                        <input type='radio' name='theme' value='dark' checked='checked'/>
                        <label for='dark'>Dark Theme</label>";
                }
                else {
                    echo "<input type='radio' name='theme' value='white' checked='checked'/>
                        <label for='white'>White Theme</label>
                        <input type='radio' name='theme' value='dark'/>
                        <label for='dark'>Dark Theme</label>";
                }
            }
            else {
                echo "<input type='radio' name='theme' value='white' checked='checked'/>
                        <label for='white'>White Theme</label>
                        <input type='radio' name='theme' value='dark'/>
                        <label for='dark'>Dark Theme</label>";
            } ?>
            <hr>
            <input type="submit" name="Envoyer" Value="Envoyer"/>
        </fieldset>
    </form>
</main>

<footer>

</footer>


</body>

</html>