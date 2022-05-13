<audio id="bgsound" autoplay loop hidden>
    <source src="../sound/RICKROLL.mp3">
    Your browser does not support the audio
</audio>

<?php
if (isset($_COOKIE["sound"])) { ?>
    <script type="text/javascript">
        const monElementAudio = document.getElementById('bgsound');
        monElementAudio.volume = 0;
    </script>
<?php }
else { ?>
    <script type="text/javascript">
        const monElementAudio = document.getElementById('bgsound');
        monElementAudio.volume = 0.1;
    </script>
<?php } ?>

</body>
</html>

