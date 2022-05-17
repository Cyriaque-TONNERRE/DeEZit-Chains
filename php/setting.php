<?php require './header.php';?>

<main>

    <audio id="bgsound" autoplay loop hidden>
        <source src="../sound/LANETROTRO.mp3">
        Your browser does not support the audio
    </audio>

    <div class="param_box">
        <h1>Settings:</h1>
        <div class="change_theme">
            Theme:
            <span id="Dark">
                Light
            </span>
        </div>
        <script>
            document.getElementById("Dark").onclick = function () {
                if (document.getElementById("Dark").innerHTML === 'Dark') {
                    document.getElementById("header_theme").href = '../css/dark_header.css';
                    document.getElementById("body_theme").href = `../css/dark_setting.css`;
                    document.cookie = `theme=dark; expires=${new Date(new Date().getTime() + 31536000000).toUTCString()}; path=/`;
                    document.getElementById("Dark").innerHTML = 'Light';
                } else {
                    document.getElementById("header_theme").href = '../css/header.css';
                    document.getElementById("body_theme").href = `../css/setting.css`;
                    document.cookie = `theme=light; expires=${new Date(new Date().getTime() + 31536000000).toUTCString()}; path=/`;
                    document.getElementById("Dark").innerHTML = 'Dark';
                }
            }
        </script>
        <br>
        <input type="range" min="0" max="100" id="Sound">
        <script>
            document.getElementById("Sound").oninput = function () {
                const monElementAudio = document.getElementById('bgsound');
                monElementAudio.volume = this.value / 100;
            }
        </script>

        <?php /*
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
*/
            ?>
    </div>
</main>

<footer>

</footer>


</body>

</html>