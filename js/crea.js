value = 5;
newc = 0;
nowc = 0;
del = false;
blockerlvl = false;
function generate_table(value) {
    // get the reference for the body
    var body = document.getElementsByTagName("body")[0];

    // creates a <table> element and a <tbody> element
    var tbl = document.createElement("table");
    tbl.id += 'tableau_crea';
    var tblBody = document.createElement("tbody");

    // creating all cells
    for (var i = 0; i < value; i++) {
        // creates a table row
        var row = document.createElement("tr");

        for (var j = 0; j < value; j++) {
        // Create a <td> element and a text node, make the text
        // node the contents of the <td>, and put the <td> at
        // the end of the table row
        var cell = document.createElement("td");
        var cellText = document.createTextNode("");
        cell.appendChild(cellText);
        row.appendChild(cell);
        cell.setAttribute("class", 'case');
        cell.setAttribute("id", '0');
        }

        // add the row to the end of the table body
        tblBody.appendChild(row);
    }
   
    // put the <tbody> in the <table>
    tbl.appendChild(tblBody);
    // appends <table> into <body>
    document.getElementById("tableau").appendChild(tbl);
    contenu();



    
    
}
function hide(){
    console.log("good");
    const pop = document.querySelector('.pop-up');
    pop.classList.add("disparition");
    generate_table(this.value);
    document.getElementById("colorlist").classList.remove('disparition');

}
document.getElementById("Range").oninput = function () {
    document.getElementById("sizeval").innerHTML = this.value;
    value = this.value;
}





function contenu(){
    chemin = [];
    cheminR = [];
    cheminB = [];
    cheminG = [];
    cheminY = [];
    cheminP = [];

    console.log("work");
    const color_cases = document.querySelectorAll('.drag'); //variable qui recup la base
    console.log(color_cases);
    const box = document.querySelectorAll('.case'); //variable qui recup toutes les cases
    
    const mouse = document.querySelector('tableau');
    
    for (const racines of color_cases) { //créer un event pour tout les élément de box
    
        racines.addEventListener('drag', drag);
        racines.addEventListener('dragstart', dragStartr); //event: lorsqu'on commence a drag appel la fonction dragStart
        racines.addEventListener('dragend', dragEndr); //event: lorsqu'on lache l'objet appel la fonction dargEnd
    }
    
    
    
    
    
    
    
    function dragStartr(e) { // FONCTION dragStart
        if(nowc !== 0){
            console.log(chemin);
            for (let m = 0; m < chemin.length; m++) {
                chemin[m].classList += ' used';
            }
            if(nowc === 'r'){
                cheminR = chemin;
            }
            if(nowc === 'b'){
                cheminB = chemin;
            }
            if(nowc === 'g'){
                cheminG = chemin;
            }
            if(nowc === 'p'){
                cheminP = chemin;
            }
            if(nowc === 'y'){
                cheminY = chemin;
            }

            chemin = [];
        }
        if(this.id !== '0'){
            nowc = this.classList[0];
            newc = this.classList[0];
        }
        const cleaner = document.querySelectorAll('.okay');
        if(cleaner !== null){
            for (let k = 0; k < cleaner.length; k++) {
                cleaner[k].classList.remove('okay');
            }
        }

        

    
    
        //setTimeout(() => (this.className = 'invisible'), 0); //permet de rendre l'objet invisible lorsqu'on drag sinon il reste afficher à son ancienne pos
    }
    
    function dragEndr(e) { //FONCTION dragEnd
        //console.log('end');
        
    
    
    
    
    }
    
    
    for (const vide of box) { //créer un event pour tout les élément de box
    
        vide.addEventListener('dragover', dragOverr); //event: lorsqu'on est en train de drag
    
        vide.addEventListener('dragenter', dragEnterr); //event: lorsqu'on est entré dans une zone ou on peut drop
    
        vide.addEventListener('dragleave', dragLeaver); //event: lorsqu'on quitte une zone de drop
    
        vide.addEventListener('drop', dragDrop); //event: lorsqu'on drop l'item
    
        vide.addEventListener('drag', drag);

        vide.addEventListener("click", increaseNum);
    }
    
    function drag(e) {
       // console.log("start")
        e.preventDefault();
 
 
        
    }
    
    function dragOverr(e) {
        e.preventDefault(); //retire l'action par default de dragOver qu'on ne veut pas
        if(this.id === '0' && nowc !== 0){
            this.classList.add(nowc);
        }
    }
    
    function dragEnterr(e) {
        e.preventDefault();
        //console.log('enter');
    }
    
    
    
    function dragLeaver(e) {
        e.preventDefault();
        if(this.classList.contains(nowc)){
            this.classList.remove(nowc);
        }

    }
    
    
    
    function dragDrop(e) {
        e.preventDefault();
        if(this.id === '0' && nowc !== 0){
            this.id = nowc;
            let racine = document.querySelector('.'+nowc+'.drag');
            racine.setAttribute('draggable', false);
            chemin.unshift(this);
            //here

            if (this.cellIndex - 1 < (document.getElementById("tableau_crea").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex - 1 >= 0) { //cell - 1G
                //GAUCHE
                if((document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex-1].id) === '0'){
                    if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex-1].classList.contains('okay'))){
                        document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex-1].classList += ' okay';
                    }
                }

            
            }
            if (this.cellIndex + 1 < (document.getElementById("tableau_crea").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex + 1 >= 0) { //cel + 1D
                //DROITE
                //Chiffre -> Pb
                if((document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex+1].id) === '0'){
                    if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex+1].classList.contains('okay'))){
                        document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex+1].classList += ' okay';
                    }
                }
                
            }
            if (this.parentNode.rowIndex - 1 < (document.getElementById("tableau_crea").rows.length) && this.parentNode.rowIndex - 1 >= 0) {
                //HAUT
                if((document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex - 1].cells[this.cellIndex].id) === '0'){
                    if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex - 1].cells[this.cellIndex].classList.contains('okay'))){
                        document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex - 1].cells[this.cellIndex].classList += ' okay';
                    }
                }
                
            }
            if (this.parentNode.rowIndex + 1 < (document.getElementById("tableau_crea").rows.length) && this.parentNode.rowIndex + 1 >= 0) {
                //BAS
                if((document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex + 1].cells[this.cellIndex].id) === '0'){
                    if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex + 1].cells[this.cellIndex].classList.contains('okay'))){
                        document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex + 1].cells[this.cellIndex].classList += ' okay';
                    }
                }
                
            }


        }
    }

    function increaseNum(){
        if(newc !== 0){
            if(this.id !== 'r' && this.id !== 'b' && this.id !== 'g' && this.id !== 'p' && this.id !== 'y' && (this.classList.contains('okay') || this.classList.contains('valid')) && !(this.classList.contains('used')))
            {
                est_nouveau = true;
                blockerlvl = false;


                let lvl = parseInt(this.id);
                if(this !== chemin[0] && chemin.indexOf(this) === -1){
                    console.log('ajout');
                    chemin.unshift(this);
                    
                }
                if(lvl !== 9){
                    if(lvl < chemin[1].id){
                        lvl = chemin[1].id
                    }
                    else if(chemin.indexOf(this) !== 0 && chemin.length !== 1){
                        console.log('ok');
                        console.log((chemin[chemin.indexOf(this)-1].id));
                        console.log(lvl);
                        if(lvl < (chemin[chemin.indexOf(this)-1].id)){
                            lvl++;
                            if(lvl === 9){
                                blockerlvl = true;
                            }
                        }
                        else{
                            del = true;
                        }
                    }
                    else{
                        lvl++;
                        if(lvl === 9){
                            blockerlvl = true;
                        }
                    }
                    
                    this.innerHTML = lvl;
                    this.id = lvl;
                    if(!this.classList.contains('valid')){
                        this.classList+=' valid';
                        est_nouveau = false;
                    }
                    else{
                        est_nouveau = true;
                    }
                    //Ici Vérif du lvl correct
            
                }
                if(lvl === 9 || del === true && !blockerlvl){
                    if(!blockerlvl){
                        del = false;
                        lvl = "";
                        this.innerHTML = lvl;
                        this.id = 0;
                        if(this.classList.contains('valid')){
                            this.classList.remove('valid');
                        }

                        est_nouveau = false;
                        if(chemin.indexOf(this) !== null){
                            console.log(chemin);
                            if(chemin.indexOf(this) !== chemin.length){
                                time = chemin.indexOf(this) + 1;
                                for (let j = 0; j < time; j++) {
                                    
                                    chemin[0].innerHTML = "";
                                    chemin[0].id = 0;
                                    if(chemin[0].classList.contains('valid')){
                                        chemin[0].classList.remove('valid');
                                    }
                                    chemin.shift();
                                }

                                
                                
                                
                            }
                        }
                        
                    }
                        

                    

                }
                
                let caseliste = document.querySelectorAll('.okay');
                if(!est_nouveau){
                    for (let i = 0; i < caseliste.length; i++) {
                        caseliste[i].classList.remove('okay');
                    }
                }

                if(!est_nouveau){
                    if (chemin[0].cellIndex - 1 < (document.getElementById("tableau_crea").rows[chemin[0].parentNode.rowIndex].cells.length) && chemin[0].cellIndex - 1 >= 0) { //cell - 1G
                        //GAUCHE
                        if((document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex].cells[chemin[0].cellIndex-1].id) === '0'){
                            if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex].cells[chemin[0].cellIndex-1].classList.contains('okay'))){
                                document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex].cells[chemin[0].cellIndex-1].classList += ' okay';
                            }
                        }
        
                    
                    }
                    if (chemin[0].cellIndex + 1 < (document.getElementById("tableau_crea").rows[chemin[0].parentNode.rowIndex].cells.length) && chemin[0].cellIndex + 1 >= 0) { //cell - 1G
                        //GAUCHE
                        if((document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex].cells[chemin[0].cellIndex+1].id) === '0'){
                            if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex].cells[chemin[0].cellIndex+1].classList.contains('okay'))){
                                document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex].cells[chemin[0].cellIndex+1].classList += ' okay';
                            }
                        }
        
                    
                    }
                    if (chemin[0].parentNode.rowIndex - 1 < (document.getElementById("tableau_crea").rows.length) && chemin[0].parentNode.rowIndex - 1 >= 0) {
                        //HAUT
                        if((document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex - 1].cells[chemin[0].cellIndex].id) === '0'){
                            if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex - 1].cells[chemin[0].cellIndex].classList.contains('okay'))){
                                document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex - 1].cells[chemin[0].cellIndex].classList += ' okay';
                            }
                        }
                        
                    }
                    if (chemin[0].parentNode.rowIndex + 1 < (document.getElementById("tableau_crea").rows.length) && this.parentNode.rowIndex + 1 >= 0) {
                        //BAS
                        if((document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex + 1].cells[chemin[0].cellIndex].id) === '0'){
                            if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex + 1].cells[chemin[0].cellIndex].classList.contains('okay'))){
                                document.getElementById('tableau_crea').getElementsByTagName('tr')[chemin[0].parentNode.rowIndex + 1].cells[chemin[0].cellIndex].classList += ' okay';
                            }
                        }
                        
                    }
                }
                }
                
        }

    }
     
    
}


