<?php require './header.php'; ?>

<main>

    <div class="param_box">
        <h1>Settings:</h1>
        <div class="change_theme">
            Theme :
            <span id="Dark">
                                <?php if (isset($_COOKIE['theme'])) {
                                    if ($_COOKIE['theme'] == 'light') { ?>
                                        Dark
                                    <?php } else { ?>
                                        Light
                                    <?php }
                                } ?>
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
                    document.getElementById("body_theme").href = `../css/setting.css`;
                    document.getElementById("header_theme").href = '../css/header.css';
                    document.cookie = `theme=light; expires=${new Date(new Date().getTime() + 31536000000).toUTCString()}; path=/`;
                    document.getElementById("Dark").innerHTML = 'Dark';
                }
            }


        </script>
        <div id="Sound_title">
            Sound : <?php echo $_COOKIE["volume"]*100 ?>%
        </div>
<<<<<<< Updated upstream
        <input type="range" min="0" max="100" value="<?php echo $_COOKIE["volume"]*100 ?>" id="Sound">
=======

        <input type="range" min="0" max="100" id="Sound">
>>>>>>> Stashed changes
        <script>
            document.getElementById("Sound").oninput = function () {
                document.cookie = `volume=${this.value / 100}; expires=${new Date(new Date().getTime() + 31536000000).toUTCString()}; path=/`;
                document.getElementById("Sound_title").innerHTML = `Sound : ${this.value}%`;
                setVolume();
            }
        </script>
    </div>
</main>

<footer>

</footer>


</body>

</html>