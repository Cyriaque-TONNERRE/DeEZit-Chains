<audio id="bgsound" autoplay loop hidden>
    <source src="../sound/LANETROTRO.mp3">
    Your browser does not support the audio
</audio>

<?php
if (isset($_COOKIE["sound"])) { ?>
    <script type="text/javascript">
        const monElementAudio = document.getElementById('bgsound');
        monElementAudio.volume = <?php echo json_encode($_COOKIE["sound"]); ?>;
    </script>
<?php }
else { ?>
    <script type="text/javascript">
        const monElementAudio = document.getElementById('bgsound');
        monElementAudio.volume = 0.5;
    </script>
<?php } ?>

</body>
</html>

