<?php
require 'header.php';
?>
    
	

    <main>
    <div class = "tmp">
        Choisissez la taille du tableau :
        <br>
        <input type="range" min="5" max="10" id="Range" value="5">
        <span id='sizeval'>5</span>
        <button id='hide' onclick='hide()'>Valider</button>
    

    </div>
    <div id='tableau'>

    </div>
    <div class="disparition" id='colorlist'>
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
        <div>
        <button id='reset' onclick='exporter()'>Exporter</button>
        </div>
        
    </div>
	</main>
    
	<script src="../js/crea.js"></script>
    <footer> 
        
    </footer>
	
</body>
