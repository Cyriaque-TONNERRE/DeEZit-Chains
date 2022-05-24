<?php require './header.php'; ?>

<main>


    <div class="param_box">
        <h1>Settings:</h1>
        <div class="change_theme">
            Theme :
            <span id="Dark" onclick="Clique()">
                                <?php if (isset($_COOKIE['theme'])) {
                                    if ($_COOKIE['theme'] == 'light') { ?>
                                        Dark
                                    <?php } else { ?>
                                        Light
                                    <?php }
                                } else { ?>
                                    Dark <?php } ?>
            </span>
        </div>
        <script>
            function Clique() {
                if (getCookie("theme") === null){
                    document.getElementById("Dark").innerHTML = 'Light';
                }
                console.log("fonction");
                var testData = document.getElementById("Dark");
                console.log(testData);
                if (document.getElementById("Dark").innerHTML === 'Light') {
                    console.log("tamamanlagentille")
                    document.getElementById("header_theme").href = '../css/dark_header.css';
                    document.getElementById("body_theme").href = `../css/dark_setting.css`;
                    document.cookie = `theme=dark; expires=${new Date(new Date().getTime() + 31536000000).toUTCString()}; path=/`;
                    document.getElementById("Dark").innerHTML = 'Dark';
                } else {
                    console.log("tamamanlamechante")
                    document.getElementById("body_theme").href = `../css/setting.css`;
                    document.getElementById("header_theme").href = '../css/header.css';
                    document.cookie = `theme=light; expires=${new Date(new Date().getTime() + 31536000000).toUTCString()}; path=/`;
                    document.getElementById("Dark").innerHTML = 'Light';
                }
            }
        </script>

        <div id="Sound_title">
            <?php if (isset($_COOKIE['volume'])) {
                $value = round($_COOKIE['volume'] * 100);
                echo "Sound : $value%";
            } else {
                echo "Sound : 50%";
            }
            ?>
        </div>

        <?php if (isset($_COOKIE['volume'])) {
            echo "<input type='range' min='0' value = '$value' max='100' id='Sound'>";
        } else {
            echo "<input type='range' min='0' value = '50' max='100' id='Sound'>";
        } ?>


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


