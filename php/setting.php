<?php require './header.php';?>

<main>
    Theme:
    <span id="Dark">
        Light
    </span>
    <script>
        document.getElementById("Dark").onclick = function () {
            if (document.getElementById("Dark").innerHTML === 'Dark') {
                document.getElementById("header_theme").href = '../css/dark_header.css';
                document.getElementById("body_theme").href = `../css/dark_setting.css`;
                document.cookie = "theme=dark";
                document.getElementById("Dark").innerHTML = 'Light';
            } else {
                document.getElementById("header_theme").href = '../css/header.css';
                document.getElementById("body_theme").href = `../css/setting.css`;
                document.cookie = "theme=light";
                document.getElementById("Dark").innerHTML = 'Dark';
            }


        }
    </script>
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
            }?>

            <br><br><hr><br>

            <?php
            if (isset($_COOKIE["sound"])) {
                echo "<input type='range' id='sound' name='sound'
                min='0' max='100' value='$_COOKIE[barsound]' step='10'>
                <label for='sound'>Music : $_COOKIE[barsound] %</label>";
            }
            else {
                echo "<input type='range' id='sound' name='sound'
                min='0' max='100' value='50' step='10'>
                <label for='sound'>Music : 50 %</label>";
            }

            ?>
            <br>
            <input type='submit' name='Envoyer' Value='Envoyer'/>
        </fieldset>
    </form>
</main>

<footer>

</footer>


</body>

</html>