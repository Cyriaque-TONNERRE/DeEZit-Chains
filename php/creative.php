<?php
require 'header.php';
?>
    
	

    <main>
    <div class = "pop-upp">
        Choisissez la taille du tableau :
        <br>
        <input type="range" min="5" max="10" id="Range" value="5">
        <span id='sizeval'>5</span>
        <button id='hide' onclick='hide()'>Valider</button>
    

    </div>
    <div id='tableau'>

    </div>
    <div class="disparition" id='colorlist'>
        <div draggable="true" class='r drag'>
            
        </div>
        <div draggable="true" class='g drag'>
            
        </div>
        <div draggable="true" class='b drag'>
            
        </div>
        <div draggable="true" class='p drag'>
            
        </div>
        <div draggable="true" class='y drag'>
            
        </div>
        
    </div>
	</main>
    
	<script src="../js/crea.js"></script>
    <footer> 
        
    </footer>
	
</body>
