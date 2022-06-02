const yellow = document.querySelector('.y'); //variable qui recup la base
yellow.addEventListener("click", cleary);
lvly = 1;
tracky = [];
starty = document.querySelector('.y');
tracky.unshift(starty);
securitey = true;
next_toury = false;
ajouty = -1;



yellow.addEventListener('dragstart', dragStarty); //event: lorsqu'on commence a drag appel la fonction dragStart
yellow.addEventListener('dragend', dragEndy); //event: lorsqu'on lache l'objet appel la fonction dargEnd
//green.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
//green.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd
yellow.addEventListener('drag', drag);

function dragStarty() { // FONCTION dragStart
    this.className += ' tenu'; //ajoute la class 'tenu' à l'objet actuel
    lasty = this;
    now = 'y';
    blocker = true;

    //setTimeout(() => (this.className = 'invisible'), 0); //permet de rendre l'objet invisible lorsqu'on drag sinon il reste afficher à son ancienne pos
}

function dragEndy() { //FONCTION dragEnd
    //this.className = 'base'; //define la class de l'objet actuel a 'base'
    if (tracky.length === 1) {
        this.setAttribute('draggable', true);
    } else {
        this.setAttribute('draggable', false);
    }


}


for (const vide of box) { //créer un event pour tout les élément de box

    vide.addEventListener('dragover', dragOvery); //event: lorsqu'on est en train de drag

    vide.addEventListener('dragenter', dragEntery); //event: lorsqu'on est entré dans une zone ou on peut drop

    vide.addEventListener('dragleave', dragLeavey); //event: lorsqu'on quitte une zone de drop

    vide.addEventListener('drop', dragDropy); //event: lorsqu'on drop l'item


}



function dragOvery(e) {
    e.preventDefault(); //retire l'action par default de dragOver qu'on ne veut pas

}

function dragEntery(e) {
    if (now === 'y') {

        e.preventDefault(); //retire l'action par default de dragEnter qu'on ne veut pas

        if (this === tracky[1]) { //Retirer élément

            securitey = false;
            tracky[0].classList.remove("y");
            tracky[0].className += ' unused';
            lvly = parseInt(tracky[1].id);
            tracky[0].setAttribute('draggable', false);
            tracky.shift();
            tracky[0].setAttribute('draggable', true);
            addactive();
            dragEntery(e);
        } else if ((tracky.indexOf(this) === -1) && securitey) {
            let voisiny = false;
            if (this.classList.contains('unused')) {
                if (lvly <= parseInt(this.id)) {
                    if (this.cellIndex - 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex - 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex - 1] === document.getElementById("tableau").rows[tracky[0].parentNode.rowIndex].cells[tracky[0].cellIndex]) {
                            voisiny = true;

                        }
                    }
                    if (this.cellIndex + 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex + 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex + 1] === document.getElementById("tableau").rows[tracky[0].parentNode.rowIndex].cells[tracky[0].cellIndex]) {
                            voisiny = true;

                        }
                    }
                    if (this.parentNode.rowIndex - 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex - 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex - 1].cells[this.cellIndex] === document.getElementById("tableau").rows[tracky[0].parentNode.rowIndex].cells[tracky[0].cellIndex]) {
                            voisiny = true;

                        }
                    }
                    if (this.parentNode.rowIndex + 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex + 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex + 1].cells[this.cellIndex] === document.getElementById("tableau").rows[tracky[0].parentNode.rowIndex].cells[tracky[0].cellIndex]) {
                            voisiny = true;

                        }
                    }
                    if (voisiny === true) {
                        ajouty++;
                        next_toury = false;
                        this.className += ' y'; //ajoute la class 'r' à l'objet actuel
                        this.classList.remove("unused");
                        lasty = this;
                        lvly = parseInt(this.id);
                        tracky[0].setAttribute('draggable', false);
                        tracky.unshift(this);
                        tracky[0].setAttribute('draggable', true);
                    }
                }
            }
        } else if (!securitey) {
            securitey = true;
        }
    }

    

}



function dragLeavey() {
    if (now === 'y') {

        if (tracky.length === 2 && ajouty === 0) {
            tracky[0].classList.remove("y");
            tracky[0].className += ' unused';
            tracky[0].setAttribute('draggable', false);
            starty.setAttribute('draggable', true);
            tracky.shift();
            lvly = 1;
            ajouty = -1;
        } else if (next_toury) {
            tracky[0].classList.remove("y");
            tracky[0].className += ' unused';
            tracky[0].setAttribute('draggable', false);
            starty.setAttribute('draggable', true);
            tracky.shift();
            lvly = 1;
            ajouty = -1;
            next_toury = false;

        }
        if (tracky.length === 2) {
            next_toury = true;
        }


        if (tracky.length === 1) {
            starty.setAttribute('draggable', true);
            blocker = false;
        }

        if (this.classList.contains("case")) {} else {
            this.className += ' case'; //définie la class de l'objet actuel à ' case'
        }
    }





}



function dragDropy() {

    if (tracky.length !== 1) {
        tracky[0].setAttribute('draggable', true);
    } else {
        starty.setAttribute('draggable', true);
    }
    addactive();

    //this.className += 'case'; //définie la class de l'objet actuel à ' case'
    //this.append(red); //change la position de la base à l'élément actuel
}

function cleary(){
    const caseliste = document.querySelectorAll('.y');
    if(caseliste !== null){
        for (let i = 0; i < caseliste.length; i++) {
            caseliste[i].classList.remove('y');
            caseliste[i].className += " unused";
            caseliste[i].setAttribute('draggable', false);
        }
        lvly = 1;
        tracky = [];
        tracky.unshift(starty);
        blocker = false;
        starty.className += ' y';
        starty.setAttribute('draggable', true);
        starty.classList.remove('unused');
        addactive();
    }

}