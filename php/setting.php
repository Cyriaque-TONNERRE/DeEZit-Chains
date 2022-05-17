<?php require './header.php';?>

<main>

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
        <span class="Sound_title">Sound:</span>
        <input type="range" min="0" max="100" id="Sound">
        <script>
            document.getElementById("Sound").oninput = function () {
                document.cookie = `volume=${this.value / 100}; expires=${new Date(new Date().getTime() + 31536000000).toUTCString()}; path=/`;
                setVolume();
            }
        </script>
    </div>
</main>

<footer>

</footer>


</body>

</html>