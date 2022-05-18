const blue = document.querySelector('.b'); //variable qui recup la base
//const box = document.querySelectorAll('.case'); //variable qui recup toutes les cases
blue.addEventListener("click", clearb);
lvlb = 1;
trackb = [];
startb = document.querySelector('.b');
trackb.unshift(startb);
securiteb = true;
next_tourb = false;
ajoutb = -1;



blue.addEventListener('drag', drag);
blue.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
blue.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd

function dragStart() { // FONCTION dragStart
    this.className += ' tenu'; //ajoute la class 'tenu' à l'objet actuel
    lastb = this;
    now = 'b';
    blocker = true;


    //setTimeout(() => (this.className = 'invisible'), 0); //permet de rendre l'objet invisible lorsqu'on drag sinon il reste afficher à son ancienne pos
}

function dragEnd() { //FONCTION dragEnd
    //this.className = 'base'; //define la class de l'objet actuel a 'base'
    if (trackb.length === 1) {
        this.setAttribute('draggable', true);
    } else {
        this.setAttribute('draggable', false);
    }




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

    if (now === 'b') {
            e.preventDefault(); //retire l'action par default de dragEnter qu'on ne veut pas
            if (this === trackb[1]) { //Retirer élément

                securiteb = false;
                trackb[0].classList.remove("b");
                trackb[0].className += ' unused';
                lvlb = parseInt(trackb[1].id);
                trackb[0].setAttribute('draggable', false);
                trackb.shift();
                dragEnter(e);
            } else if ((trackb.indexOf(this) === -1) && securiteb) {
                let voisinb = false;
                if (this.classList.contains("unused")) {
                    if (lvlb <= parseInt(this.id)) {
                        if (this.cellIndex - 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex - 1 >= 0) {
                            if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex - 1] === document.getElementById("tableau").rows[trackb[0].parentNode.rowIndex].cells[trackb[0].cellIndex]) {
                                voisinb = true;
                            }
                        }
                        if (this.cellIndex + 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex + 1 >= 0) {
                            if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex + 1] === document.getElementById("tableau").rows[trackb[0].parentNode.rowIndex].cells[trackb[0].cellIndex]) {
                                voisinb = true;
                            }
                        }
                        if (this.parentNode.rowIndex - 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex - 1 >= 0) {
                            if (document.getElementById("tableau").rows[this.parentNode.rowIndex - 1].cells[this.cellIndex] === document.getElementById("tableau").rows[trackb[0].parentNode.rowIndex].cells[trackb[0].cellIndex]) {
                                voisinb = true;
                            }
                        }
                        if (this.parentNode.rowIndex + 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex + 1 >= 0) {
                            if (document.getElementById("tableau").rows[this.parentNode.rowIndex + 1].cells[this.cellIndex] === document.getElementById("tableau").rows[trackb[0].parentNode.rowIndex].cells[trackb[0].cellIndex]) {
                                voisinb = true;
                            }
                        }
                        if (voisinb === true) {
                            ajoutb++;
                            next_tourb = false;
                            this.className += ' b'; //ajoute la class 'b' à l'objet actuel
                            this.classList.remove("unused");
                            lastb = this;
                            lvlb = parseInt(this.id);
                            trackb[0].setAttribute('draggable', false);
                            trackb.unshift(this);
                            trackb[0].setAttribute('draggable', true);

                        }
                    }
                }
            } else if (!securiteb) {
                securiteb = true;
            }
    } else console.log("flash");
    
}




function dragLeave() {
    if (now === 'b') {
        if (trackb.length === 2 && ajoutb === 0) {
            trackb[0].classList.remove("b");
            trackb[0].className += ' unused';
            trackb[0].setAttribute('draggable', false);
            startb.setAttribute('draggable', true);
            trackb.shift();
            lvlb = 1;
            ajoutb = -1;
        } else if (next_tourb) {
            trackb[0].classList.remove("b");
            trackb[0].className += ' unused';
            trackb[0].setAttribute('draggable', false);
            startb.setAttribute('draggable', true);
            trackb.shift();
            lvlb = 1;
            ajoutb = -1;
            next_tourb = false;

        }
        if (trackb.length === 2) {
            next_tourb = true;
        }


        if (trackb.length === 1) {
            startb.setAttribute('draggable', true);
            blocker = false;
        }

        if (this.classList.contains("case")) {} else {
            this.className += ' case'; //définie la class de l'objet actuel à ' case'
        }
    }





}



function dragDrop() {
    if (trackb.length !== 1) {
        trackb[0].setAttribute('draggable', true);
    } else {
        startb.setAttribute('draggable', true);
    }

    //this.className += 'case'; //définie la class de l'objet actuel à ' case'
    //this.append(red); //change la position de la base à l'élément actuel
}

function clearb(){
    const caseliste = document.querySelectorAll('.b');
    if(caseliste !== null){
        for (let i = 0; i < caseliste.length; i++) {
            caseliste[i].classList.remove('b');
            caseliste[i].className += " unused";
            caseliste[i].setAttribute('draggable', false);
        }
        lvlb = 1;
        trackb = [];
        trackb.unshift(startb);
        blocker = false;
        startb.className += ' b';
        startb.setAttribute('draggable', true);
        startb.classList.remove('unused');
    }

}