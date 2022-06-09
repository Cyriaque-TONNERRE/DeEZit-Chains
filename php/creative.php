<?php
require 'header.php';
?>

    <main>
    <div class='tuto2 disparition'>
            <img src='../image/xmark-solid.svg' alt='Croix' id='close_tuto' draggable='false' onclick='tutoHide2()'/>
            <img id='tuto' alt='tuto' draggable='false' src='../image/creative_tuto.jpeg'>
            </div>
        <?php
        if(isset($_COOKIE["tuto"])){
            echo "<div class='tuto disparition'>
            <img src='../image/xmark-solid.svg' alt='Croix' id='close_tuto' draggable='false' onclick='tutoHide()'/>
            <img id='tuto' alt='tuto' draggable='false' src='../image/creative_tuto.jpeg'>
            </div>";
            echo "<div class = 'tmp'>
            Choose the grid's size :
            <br>
            <input type='range' min='5' max='10' id='Range' value='5'>
            <span id='sizeval'>5</span>
            <button id='hide' onclick='hide()' style='width: 5vw'>Confirm</button>
        </div>";
        }
        else{
            echo "<div class='tuto'>
            <img src='../image/xmark-solid.svg' alt='Croix' id='close_tuto' draggable='false' onclick='tutoHide()'/>
            <img id='tuto' alt='tuto' draggable='false' src='../image/creative_tuto.jpeg'>
            </div>";
            echo "<div class = 'tmp disparition'>
            Choose the grid's size :
            <br>
            <input type='range' min='5' max='10' id='Range' value='5'>
            <span id='sizeval'>5</span>
            <button id='hide' onclick='hide()' style='width: 5vw'>Confirm</button>
            </div>";
        }
        ?>


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
            <div draggable="true" class='y drag' id='y'>

            </div>
            <div draggable="true" class='p drag' id='p'>

            </div>

            <button id = 'export' onclick='exporter()'>Export</button>
             <button id='buttonTuto' onclick='tutoHide()'>Tutorial</button>


            
            
        </div>

        
        
        


        
    </div>
        <section>
            <div class = "export disparition" id="exportationLvl">
            <img src="../image/xmark-solid.svg" alt="croix" id="closeExporter" onclick="closeExporter()"/>
                <div id="center">
                    <label for="levelName" id="lvllabel">Level Name :</label><br>
                    <input type="text" id="lvlName" value="levelExport"><br>
                    <button id='download' onclick='install()'>download</button>
                </div>
            </div>
        </section>
    </main>
	<script src="../js/crea.js"></script>
</body>
