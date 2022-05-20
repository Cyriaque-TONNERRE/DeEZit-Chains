value = 5;
newc = 0; //Variable de protection pour éviter la duplication de couleurs
nowc = 0; //Variable afin de conserver la couleur dans laquelle nous sommes
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
        var cell = document.createElement("td");
        var cellText = document.createTextNode("");
        cell.appendChild(cellText);
        row.appendChild(cell);
        cell.setAttribute("class", 'case');
        cell.setAttribute("id", '0');
        }

        tblBody.appendChild(row);
    }
   
    // put the <tbody> in the <table>
    tbl.appendChild(tblBody);
    // appends <table> into <body>
    document.getElementById("tableau").appendChild(tbl);
    contenu();



    
    
}
function hide(){
    //Cacher la pop-up
    console.log("good");
    const pop = document.querySelector('.tmp');
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
        racines.classList += ' disparition';
        
    }
    document.querySelector('.r.drag').classList.remove('disparition');
    
    
    
    
    
    
    
    function dragStartr(e) { // FONCTION dragStart
        console.log('start');
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
        if(this.id === '0' && newc !== 0){
            this.classList.add(newc);
        }
    }
    
    function dragEnterr(e) {
        e.preventDefault();
        //console.log('enter');
    }
    
    
    
    function dragLeaver(e) {
        e.preventDefault();
        if(newc !== 0){
            if(this.classList.contains(newc)){
                this.classList.remove(newc);
            }
        }


    }
    
    
    
    function dragDrop(e) {
        e.preventDefault();
        if(this.id === '0' && nowc !== 0 && newc !== 0){
            this.id = nowc;
            let racine = document.querySelector('.'+nowc+'.drag');
            newc = 0;
            racine.setAttribute('draggable', false);
            racine.classList += ' disparition';
            if(nowc === 'r'){
                document.querySelector('.g.drag').classList.remove('disparition');
            }
            else if(nowc === 'g'){
                document.querySelector('.b.drag').classList.remove('disparition');
            }
            else if(nowc === 'b'){
                document.querySelector('.p.drag').classList.remove('disparition');
            }
            else if(nowc === 'p'){
                document.querySelector('.y.drag').classList.remove('disparition');
            }
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
        if(nowc !== 0){
            if(this.id !== 'r' && this.id !== 'b' && this.id !== 'g' && this.id !== 'p' && this.id !== 'y' && (this.classList.contains('okay') || this.classList.contains('valid')) && !(this.classList.contains('used')))
            {
                est_nouveau = true;
                blockerlvl = false;

                nouvellecase = false;

                let lvl = parseInt(this.id);
                if(this !== chemin[0] && chemin.indexOf(this) === -1){
                    console.log('ajout');
                    chemin.unshift(this);
                    nouvellecase = true;
                    
                    
                    
                }
                if(lvl !== 9){
                    if(lvl < chemin[1].id){
                        console.log("bug from here ?");
                        if(nouvellecase){
                            lvl = chemin[1].id
                        }
                        else{
                           lvl++; 
                        }
                        nouvellecase = false;
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
            else if(this.id === 'r' || this.id === 'b' || this.id === 'g' || this.id === 'p' || this.id === 'y'){
                console.log('test');
                if(this.id === 'r' && nowc !== 'r'){
                    road = cheminR;
                    cheminR = [];
                    cheminR.unshift(road[road.length]);
                }
                else if(this.id === 'g' && nowc !== 'g'){
                    road = cheminG;
                    cheminG = [];
                    cheminG.unshift(road[road.length-1]);
                }
                else if(this.id === 'b' && nowc !== 'b'){
                    road = cheminB;
                    cheminB = [];
                    cheminB.unshift(road[road.length-1]);
                }
                else if(this.id === 'p' && nowc !== 'p'){
                    road = cheminP;
                    cheminP = [];
                    cheminP.unshift(road[road.length-1]);
                }
                else if(this.id === 'y' && nowc !== 'y'){
                    road = cheminY;
                    cheminY = [];
                    cheminY.unshift(road[road.length-1]);
                }
                else{
                    
                    road = chemin;
                    chemin = [];
                    chemin.unshift(road[road.length-1]);
                }
                console.log(road);

                if(road !== null){
                    if(road.length !== 0){
                        let time = road.length - 1;
                        for (let o = 0; o < time; o++) {
                                        
                            road[0].innerHTML = "";
                            road[0].id = 0;
                            if(road[0].classList.contains('valid')){
                                road[0].classList.remove('valid');
                            }
                            road.shift();

                        }

                        if(nowc === this.id){
                            let caseliste = document.querySelectorAll('.okay');
                            if(caseliste !== null){
                                for (let i = 0; i < caseliste.length; i++) {
                                    caseliste[i].classList.remove('okay');
                                }
                            }

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
                }
            }
                
        }
        

    }
     
    
}




