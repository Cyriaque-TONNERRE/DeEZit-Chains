value = 5;
newc = 0; //Variable de protection pour éviter la duplication de couleurs
nowc = 0; //Variable afin de conserver la couleur dans laquelle nous sommes
del = false;
deplacement_color = false
blockerlvl = false;
before = "";
last = "";
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
function tutoHide(){
    //Cacher la pop-up
    console.log("good");
    const pop2 = document.querySelector('.tuto');
    pop2.classList.add("disparition");
    const next = document.querySelector('.tmp');
    next.classList.remove('disparition');



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
    color_cases = document.querySelectorAll('.drag'); //variable qui recup la base
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
        console.log('end');
        
    
    
    
    
    }
    
    
    for (const vide of box) { //créer un event pour tout les élément de box
    
        vide.addEventListener('dragover', dragOverr); //event: lorsqu'on est en train de drag
    
        vide.addEventListener('dragenter', dragEnterr); //event: lorsqu'on est entré dans une zone ou on peut drop
    
        vide.addEventListener('dragleave', dragLeaver); //event: lorsqu'on quitte une zone de drop
    
        vide.addEventListener('drop', dragDrop); //event: lorsqu'on drop l'item
    
        vide.addEventListener('drag', drag);

        vide.addEventListener("click", increaseNum);

        vide.addEventListener("dblclick", delete_case);  
    }
    
    function drag(e) {
       //console.log("start")
        e.preventDefault();
        before=this;
        
    }

    function dragEnterr(e) {
        e.preventDefault();
        console.log('enter');
        
        if((this.classList.contains("deplacements"))){
            chemin = [];
            newc = nowc;

            console.log("je del");
            last = this;
            deplacement_color = true;
            
        }
       

    }
    
  
    blockerspam = false;
    function dragLeaver(e) {
        console.log(blockerspam);
        e.preventDefault();
        if(!blockerspam){
            if(newc !== 0){
                if(this.classList.contains(newc) && !this.classList.contains("deplacements") && this.id !== newc){
                        this.classList.remove(newc);
                }
            }
        }
        
        if (this.cellIndex - 1 < (document.getElementById("tableau_crea").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex - 1 >= 0) {
            if(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex-1].classList.contains('colors')){
                blockerspam = true;
                console.log("good");
            }
        }
        else if (this.cellIndex + 1 < (document.getElementById("tableau_crea").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex + 1 >= 0) {
            if(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex+1].classList.contains('colors')){
                blockerspam = true;
                console.log("good2");
            }

        }
        else{
            blockerspam = false;
        }


    }
    
    function dragOverr(e) {
        e.preventDefault(); //retire l'action par default de dragOver qu'on ne veut pas
        //console.log(blockerspam);

        /*if(!blockerspam){
            if(this.id === '0' && newc !== 0 && !this.classList.contains(newc)){
                this.className += (" "+newc);
            }
        }
        */
        

        
    }
    
    function dragDrop(e) {

        console.log("drop");
        blockerspam = false;
        e.preventDefault();
        if(this.id === '0' && nowc !== 0 && newc !== 0 && !(this.classList.contains('used'))){
            //On reset dans un premier tps
            let use = document.querySelectorAll('.used');
            if(use){
                for (let i = 0; i < use.length; i++) {
                    use[i].classList.remove("used");
                }
            }

            let dpl = document.querySelectorAll('.deplacements');
            if(dpl){
                for (let i = 0; i < dpl.length; i++) {
                    console.log(dpl[i]);
                    dpl[i].classList.remove("deplacements");
                    if(dpl[i].id === nowc){
                        dpl[i].id = '0';
                    }
                }
            }

            this.id = nowc;
            let casesource = document.querySelectorAll('.'+nowc);
            let racine = document.querySelector('.'+nowc+'.drag');
            for (let i = 0; i < casesource.length; i++) {
                if(!casesource[i].classList.contains("drag")){
                    casesource[i].classList.remove(nowc);
                    casesource[i].classList.remove("colors");
                }
                
            }




            if(!this.classList.contains(newc)){
                this.classList.add(newc);
            }
            if(!deplacement_color){
                newc = 0;
            }
            
            if(racine){
                racine.setAttribute('draggable', false);
                if(!(racine.classList.contains("disparition"))){
                    racine.classList += ' disparition';
                }
                
            }
            
            let liste_couleurs = document.querySelectorAll('.colors'); //Permet de rendre la case draggable
            for (let i = 0; i < liste_couleurs.length; i++) {
                liste_couleurs[i].setAttribute("draggable",false);
                if(liste_couleurs[i].classList.contains("deplacements")){
                    liste_couleurs[i].classList.remove("deplacements");
                }
            }

            //Supprimer les anciens okays
            let caseliste = document.querySelectorAll('.okay');
            for (let i = 0; i < caseliste.length; i++) {
                caseliste[i].classList.remove('okay');
            }

            if(deplacement_color){
                console.log(newc);
                console.log('here ?');
                console.log(last);
                
                if(last.classList.contains(newc) && last !== this){
                    
                    last.id = "0";
                    last.classList.remove('remove');
                    last.classList.remove('colors');
                    last.classList.remove(newc);
                    
                }
                last.setAttribute("draggable",false);
                

                
                //deplacement_color = false;

            }
            if(last){
                console.log(this);
                console.log(last);
                if(last === this ){
                    deplacement_color = false;
                }
                else if(last.classList.contains("colors")){
                    deplacement_color = false;
                }
            }

            
            this.setAttribute("draggable",true);
            this.classList += " deplacements";
            this.classList += " colors";
            
            
            if(!deplacement_color){
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
            }
            
            chemin.unshift(this);
            deplacement_color = false;
            //here

            if (this.cellIndex - 1 < (document.getElementById("tableau_crea").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex - 1 >= 0) { //cell - 1G
                //GAUCHE
                console.log("gauche");
                if((document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex-1].id) === '0'){
                    console.log((document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex-1].id));
                    if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex-1].classList.contains('okay'))){
                        document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex-1].classList += ' okay';
                    }
                }

            
            }
            if (this.cellIndex + 1 < (document.getElementById("tableau_crea").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex + 1 >= 0) { //cel + 1D
                //DROITE
                console.log("droite");
                //Chiffre -> Pb
                if((document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex+1].id) === '0'){
                    if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex+1].classList.contains('okay'))){
                        document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex].cells[this.cellIndex+1].classList += ' okay';
                    }
                }
                
            }
            if (this.parentNode.rowIndex - 1 < (document.getElementById("tableau_crea").rows.length) && this.parentNode.rowIndex - 1 >= 0) {
                //HAUT
                console.log("haut");
                if((document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex - 1].cells[this.cellIndex].id) === '0'){
                    if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex - 1].cells[this.cellIndex].classList.contains('okay'))){
                        document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex - 1].cells[this.cellIndex].classList += ' okay';
                    }
                }
                
            }
            if (this.parentNode.rowIndex + 1 < (document.getElementById("tableau_crea").rows.length) && this.parentNode.rowIndex + 1 >= 0) {
                //BAS
                console.log("bas");
                if((document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex + 1].cells[this.cellIndex].id) === '0'){
                    if(!(document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex + 1].cells[this.cellIndex].classList.contains('okay'))){
                        document.getElementById('tableau_crea').getElementsByTagName('tr')[this.parentNode.rowIndex + 1].cells[this.cellIndex].classList += ' okay';
                    }
                }
                
            }


        }
        else{
            if(this.classList.contains('r')){
                nowc = 'r';
                newc = 'r';
            }
            else if(this.classList.contains('g')){
                nowc = 'g';
                newc = 'g';
            }
            else if(this.classList.contains('b')){
                nowc = 'b';
                newc = 'b';
            }
            else if(this.classList.contains('p')){
                nowc = 'p';
                newc = 'p';
            }
            else if(this.classList.contains('y')){
                nowc = 'y';
                newc = 'y';
            }
        }
    }

    function increaseNum(){
        if(nowc !== 0){
            if(this.id !== 'r' && this.id !== 'b' && this.id !== 'g' && this.id !== 'p' && this.id !== 'y' && (this.classList.contains('okay') || this.classList.contains('valid')) && !(this.classList.contains('used')))
            {
                deplacement_color = false;
                
                est_nouveau = true;
                blockerlvl = false;

                nouvellecase = false;

                let lvl = parseInt(this.id);
                if(this !== chemin[0] && chemin.indexOf(this) === -1 && (cheminR.indexOf(this) === -1) && (cheminG.indexOf(this) === -1) && (cheminB.indexOf(this) === -1) && (cheminP.indexOf(this) === -1) && (cheminY.indexOf(this) === -1)){
                    chemin[0].setAttribute("draggable",false);
                    chemin.unshift(this);
                    nouvellecase = true;
                    
                    
                    
                    
                }
                if(lvl !== 9){
                    if(lvl < chemin[1].id){
                        
                        if(nouvellecase){
                            lvl = chemin[1].id
                        }
                        else{
                           lvl++; 
                        }
                        nouvellecase = false;
                    }
                    else if(chemin.indexOf(this) !== 0 && chemin.length !== 1){
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
                        console.log(chemin);
                        if((cheminR.indexOf(this) === -1) && (cheminG.indexOf(this) === -1) && (cheminB.indexOf(this) === -1) && (cheminP.indexOf(this) === -1) && (cheminY.indexOf(this) === -1)){
                            lvl++;
                            if(lvl === 9){
                                blockerlvl = true;
                            }
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
                        //DROITE
                        console.log("droite");
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
                let liste_couleurs = document.querySelectorAll('.colors'); //Permet de rendre la case draggable
                for (let i = 0; i < liste_couleurs.length; i++) {
                    liste_couleurs[i].setAttribute("draggable",false);
                    if(liste_couleurs[i].classList.contains("deplacements")){
                        liste_couleurs[i].classList.remove("deplacements");
                    }
                }
                this.setAttribute("draggable",true);
                this.classList += " deplacements";
                if(this.id === 'r' && nowc !== 'r'){

                    //Changement vers rouge
                    //Supprimer tout le rouge et enregistrer avant
                    road = cheminR;
                    if(nowc === 'g'){
                        cheminG = chemin;
                    }
                    else if(nowc === 'b'){
                        cheminB = chemin;
                    }
                    else if(nowc === 'p'){
                        cheminP = chemin;
                    }
                    else if(nowc === 'y'){
                        cheminY = chemin;
                    }
                    chemin = [];
                    chemin.unshift(this);
                    nowc = 'r';
                }
                else if(this.id === 'g' && nowc !== 'g'){
                    road = cheminG;
                    if(nowc === 'r'){
                        cheminR = chemin;
                    }
                    else if(nowc === 'b'){
                        cheminB = chemin;
                    }
                    else if(nowc === 'p'){
                        cheminP = chemin;
                    }
                    else if(nowc === 'y'){
                        cheminY = chemin;
                    }
                    chemin = [];
                    chemin.unshift(this);
                    nowc = 'g';
                }
                else if(this.id === 'b' && nowc !== 'b'){
                    road = cheminB;
                    if(nowc === 'r'){
                        cheminR = chemin;
                    }
                    else if(nowc === 'g'){
                        cheming = chemin;
                    }
                    else if(nowc === 'p'){
                        cheminP = chemin;
                    }
                    else if(nowc === 'y'){
                        cheminY = chemin;
                    }
                    chemin = [];
                    chemin.unshift(this);
                    nowc = 'b';
                }
                else if(this.id === 'p' && nowc !== 'p'){
                    road = cheminP;
                    if(nowc === 'r'){
                        cheminR = chemin;
                    }
                    else if(nowc === 'b'){
                        cheminB = chemin;
                    }
                    else if(nowc === 'g'){
                        cheminG = chemin;
                    }
                    else if(nowc === 'y'){
                        cheminY = chemin;
                    }
                    chemin = [];
                    chemin.unshift(this);
                    nowc = 'p';
                }
                else if(this.id === 'y' && nowc !== 'y'){
                    road = cheminY;
                    if(nowc === 'r'){
                        cheminR = chemin;
                    }
                    else if(nowc === 'b'){
                        cheminB = chemin;
                    }
                    else if(nowc === 'p'){
                        cheminP = chemin;
                    }
                    else if(nowc === 'g'){
                        cheminG = chemin;
                    }
                    chemin = [];
                    chemin.unshift(this);
                    nowc = 'y';
                }
                else{
                    road = chemin;
                    chemin = [];
                    chemin.unshift(road[road.length-1]);
                }
                console.log(road);

                if(road !== null){
                    //Supression 
                    if(road.length !== 0){
                        let time = road.length - 1;



                        for (let o = 0; o < time; o++) {
                                        
                            road[0].innerHTML = "";
                            road[0].id = 0;
                            if(road[0].classList.contains('valid')){
                                road[0].classList.remove('valid');
                            }
                            if(road[0].classList.contains('used')){
                                road[0].classList.remove('used');
                            }
                            road.shift();

                        }
                            
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
                            console.log("droite");
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

function supression_couleur(elem){
    if(elem.id === 'r' || elem.id == 'g' || elem.id === 'b' || elem.id === 'p' || elem.id === 'y'){
        console.log("eureka");
        elem.setAttribute("draggable",false);
        elem.classList = "case";
        let caseliste = document.querySelectorAll('.okay');
        if(caseliste !== null){
            for (let i = 0; i < caseliste.length; i++) {
                caseliste[i].classList.remove('okay');
            }
        }
        for (let lst_racines of color_cases) { //créer un event pour tout les élément de box
    
            if (!(lst_racines.classList.contains("disparition"))){
                lst_racines.classList += " disparition";
            }
            if(lst_racines.id === elem.id){
                
                if (lst_racines.classList.contains("disparition")){
                    lst_racines.classList.remove("disparition");
                    lst_racines.setAttribute("draggable",true);
                }
            }
            
            
        }
        elem.id = '0';

    }
}

function retirer_chiffres(elem){
    if(elem.id === 'g'){
        road = cheminG;
        cheminG = [];
    }
    else if(elem.id === 'r'){
        road = cheminR;
        cheminR = [];
    }
    else if(elem.id === 'b'){
        road = cheminB;
        cheminB = [];
    }
    else if(elem.id === 'y'){
        road = cheminY;
        cheminY = [];
    }
    else if(elem.id === 'p'){
        road = cheminP;
        cheminP = [];
    }
    let time = road.length - 1;

    for (let o = 0; o < time; o++) {
                                        
        road[0].innerHTML = "";
        road[0].id = 0;
        if(road[0].classList.contains('valid')){
            road[0].classList.remove('valid');
        }
        if(road[0].classList.contains('used')){
            road[0].classList.remove('used');
        }
        road.shift();

    }
        
    let caseliste = document.querySelectorAll('.okay');
    if(caseliste !== null){
        for (let i = 0; i < caseliste.length; i++) {
            caseliste[i].classList.remove('okay');
        }
    }
}

function delete_case(){
    if(this.id === 'r' || this.id == 'g' || this.id === 'b' || this.id === 'p' || this.id === 'y'){

        if(this.id === 'y'){
            supression_couleur(this);
            chemin = [];
            cheminY = [];
        }
        else if(this.id === 'p'){
            chemin = [];
            if(document.querySelector('.y.colors')){
                retirer_chiffres(document.querySelector('.y.colors'));
                supression_couleur(document.querySelector('.y.colors'));
            }
            supression_couleur(this);
            
        }
        else if(this.id === 'b'){
            chemin = [];
            if(document.querySelector('.p.colors')){
                retirer_chiffres(document.querySelector('.p.colors'));
                supression_couleur(document.querySelector('.p.colors'));
            }
            if(document.querySelector('.y.colors')){
                retirer_chiffres(document.querySelector('.y.colors'));
                supression_couleur(document.querySelector('.y.colors'));
            }
            supression_couleur(this);
            
        }
        else if(this.id === 'g'){
            chemin = [];
            if(document.querySelector('.b.colors')){
                retirer_chiffres(document.querySelector('.b.colors'));
                supression_couleur(document.querySelector('.b.colors'));
            }
            if(document.querySelector('.p.colors')){
                retirer_chiffres(document.querySelector('.p.colors'));
                supression_couleur(document.querySelector('.p.colors'));
            }
            if(document.querySelector('.y.colors')){
                retirer_chiffres(document.querySelector('.y.colors'));
                supression_couleur(document.querySelector('.y.colors'));
            }
            supression_couleur(this);
            
        }
        else if(this.id === 'r'){
            chemin = [];
            if(document.querySelector('.g.colors')){
                retirer_chiffres(document.querySelector('.g.colors'));
                supression_couleur(document.querySelector('.g.colors'));
            }
            if(document.querySelector('.b.colors')){
                retirer_chiffres(document.querySelector('.b.colors'));
                supression_couleur(document.querySelector('.b.colors'));
            }
            if(document.querySelector('.p.colors')){
                retirer_chiffres(document.querySelector('.p.colors'));
                supression_couleur(document.querySelector('.p.colors'));
            }
            if(document.querySelector('.y.colors')){
                retirer_chiffres(document.querySelector('.y.colors'));
                supression_couleur(document.querySelector('.y.colors'));
            }
            supression_couleur(this);
            
        }

    }


    

}

function download(filename, textInput) {

    var element = document.createElement('a');
    element.setAttribute('href','data:text/plain;charset=utf-8, ' + encodeURIComponent(textInput));
    element.setAttribute('download', filename);
    document.body.appendChild(element);
    element.click();
    //document.body.removeChild(element);
}

filename = "niveauExporter.json";
document.getElementById("lvlName").oninput = function () {
    filename = document.getElementById("lvlName").value;
}

function exporter(){

    let tab = document.querySelectorAll('.case');
    Fexporter = {
        level: []
    };
    if (document.getElementsByClassName('pop-up')[0] !== undefined) {
        Fexporter.author = document.getElementsByClassName('pop-up')[0].innerHTML.split(' ')[1];
    } else (
        Fexporter.author = "anonyme"
    )
    let i = 0;
    let j = 0;
    for (const boxes of tab) {
        Fexporter.level[j] += boxes.id.toString();
        //console.log(exporter.level);
        //console.log(j);
        i++;
        if (i === parseInt(value)) {
            const tmp = Fexporter.level[j];
            Fexporter.level[j] = tmp.substring(9);
            i = 0;
            j++;
        }
    }
    console.log(Fexporter);
    

    document.getElementById("exportationLvl").classList.remove('disparition');
    document.getElementById("colorlist").classList += ' disparition';
    document.getElementById("tableau").classList += ' disparition';
    
    
    console.log(filename);

}

function closeExporter() {
    document.getElementById("exportationLvl").classList += ' disparition';
    document.getElementById("colorlist").classList.remove('disparition');
    document.getElementById("tableau").classList.remove('disparition');

}


function install() {
    if(filename === ""){
        Fexporter.name = "niveauExporter";
        filename = "niveauExporter.json";
    }
    else{
        Fexporter.name = filename;
        filename += ".json";
    }
    
    fichier = JSON.stringify(Fexporter)
    download(filename, fichier);

}




