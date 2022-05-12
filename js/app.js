const red = document.querySelector('.r'); //variable qui recup la base
//const green = document.querySelector('.g'); //variable qui recup la base
const box = document.querySelectorAll('.case'); //variable qui recup toutes les cases
let lvl = 1;
let track = [];
start = document.querySelector('.r');
track.unshift(start);
securite = true;
next_tour = false;
ajout = -1;



red.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
red.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd
//green.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
//green.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd

function dragStart() { // FONCTION dragStart
    this.className += ' tenu'; //ajoute la class 'tenu' à l'objet actuel
    last = this;
    

    //setTimeout(() => (this.className = 'invisible'), 0); //permet de rendre l'objet invisible lorsqu'on drag sinon il reste afficher à son ancienne pos
}

function dragEnd() { //FONCTION dragEnd
    //this.className = 'base'; //define la class de l'objet actuel a 'base'
    this.classList.remove("tenu");
    this.setAttribute('draggable', false);
    


}


for (const vide of box) { //créer un event pour tout les élément de box

    vide.addEventListener('dragover', dragOver); //event: lorsqu'on est en train de drag

    vide.addEventListener('dragenter', dragEnter); //event: lorsqu'on est entré dans une zone ou on peut drop

    vide.addEventListener('dragleave', dragLeave); //event: lorsqu'on quitte une zone de drop

    vide.addEventListener('drop', dragDrop); //event: lorsqu'on drop l'item


}



function dragOver(e) {
    e.preventDefault(); //retire l'action par default de dragOver qu'on ne veut pas

}

function dragEnter(e) {
    e.preventDefault(); //retire l'action par default de dragEnter qu'on ne veut pas
    console.log("renter");
    console.log(track);
    console.log(this.cellIndex);
    //if(((this.cellIndex==track[0].cellIndex+1 || this.cellIndex==track[0].cellIndex-1 || this.cellIndex==track[0].cellIndex) && this.className!="invicible")^((this.cellIndex==track[0].parentNode.rowIndex+1 || this.cellIndex==track[0].parentNode.rowIndex-1 || this.cellIndex==track[0].parentNode.rowIndex) && this.className!="invicible")){
        if(this === track[1]){ //Retirer élément

            securite = false;
            track[0].classList.remove("r");
            track[0].className += ' unused';
            lvl = parseInt(track[0].id);
            track.shift();

        }
        else if((track.indexOf(this) === -1) && securite){
            if (this.className !== "r") {
                ajout++;
                if(lvl <= parseInt(this.id)){
                    this.className += ' r';  //ajoute la class 'r2' à l'objet actuel
                    this.classList.remove("unused");
                    last = this;
                    lvl = parseInt(this.id);
                    track.unshift(this);
                    if(document.querySelector('.unused') === null){
                        //Victoire
                        document.location.href="index.php";
                    }
                }
            }
        }
        else if(!securite){
            securite = true;
        }

  //  }

}



function dragLeave() {
    console.log("Sortie");
    console.log(track.length);
    if(track.length === 2 && ajout===0){
        track[0].classList.remove("r");
        track[0].className += ' unused';
        track.shift();
    }
    else if(next_tour){
        track[0].classList.remove("r");
        track[0].className += ' unused';
        track.shift();
    }
    if(track.length === 2){
        next_tour = true;
    }


    if (this.classList.contains("case")) {
       
    } else {
        this.className += ' case'; //définie la class de l'objet actuel à ' case'
    }


    
    
    
}
    


function dragDrop() {
    console.log("Drop");
    if(track.length !== 0){
        track[0].setAttribute('draggable', true);
    }
    else{
        start.setAttribute('draggable', true);
    }

    //this.className += 'case'; //définie la class de l'objet actuel à ' case'
    //this.append(red); //change la position de la base à l'élément actuel
}