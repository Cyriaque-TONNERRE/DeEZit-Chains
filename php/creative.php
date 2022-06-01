<?php
require 'header.php';
?>

    <main>
    <div class="tuto">
        <img src="../image/xmark-solid.svg" alt="Croix" id="close_tuto" draggable='false' onclick='tutoHide()'/>
        <img id="tuto" alt="tuto" draggable="false" src="../image/creative_tuto.jpeg">
    </div>
    <div class = "tmp disparition">
        Choose the grid's size :
        <br>
        <input type="range" min="5" max="10" id="Range" value="5">
        <span id='sizeval'>5</span>
        <button id='hide' onclick='hide()' style="width: 5vw">Valider</button>
    </div>

    <div id='tableau' draggable="false">

    </div>
    <div class="disparition" id='colorlist'>
        <div class="EZ">
            <div draggable="true" class='r drag' id='r'>

            </div>
            <div draggable="true" class='g drag' id='g'>

            </div>
            <div draggable="true" class='b drag' id='b'>

            </div>
            <div draggable="true" class='p drag' id='p'>

            </div>
            <div draggable="true" class='y drag' id='y'>

            </div>
        </div>


        <button id = 'export' onclick='exporter()'>Exporter</button>
        


        
    </div>
        <section>
    <div class = "export disparition" id="exportationLvl">
        <div id = btn><button id='closeExporter' onclick='closeExporter()'>X</button></div>
        <label for="levelName">Level Name : </label>
        <input type="text" id="lvlName">

        <button id='download' onclick='install()'>download</button>

    </div>
        </section>
    </main>
	<script src="../js/crea.js"></script>

	
</body>
