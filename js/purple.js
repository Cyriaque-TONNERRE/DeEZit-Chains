const purple = document.querySelector('.p'); //variable qui recup la base
purple.addEventListener("click", clearp);
lvlp = 1;
trackp = [];
startp = document.querySelector('.p');
trackp.unshift(startp);
securitep = true;
next_tourp = false;
ajoutp = -1;



purple.addEventListener('dragstart', dragStartp); //event: lorsqu'on commence a drag appel la fonction dragStart
purple.addEventListener('dragend', dragEndp); //event: lorsqu'on lache l'objet appel la fonction dargEnd
//green.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
//green.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd
purple.addEventListener('drag', drag);

function dragStartp() { // FONCTION dragStart
    this.className += ' tenu'; //ajoute la class 'tenu' à l'objet actuel
    lastp = this;
    now = 'p';
    blocker = true;


    //setTimeout(() => (this.className = 'invisible'), 0); //permet de rendre l'objet invisible lorsqu'on drag sinon il reste afficher à son ancienne pos
}

function dragEndp() { //FONCTION dragEnd
    //this.className = 'base'; //define la class de l'objet actuel a 'base'
    this.classList.remove("tenu");
    if (trackp.length === 1) {
        this.setAttribute('draggable', true);
    } else {
        this.setAttribute('draggable', false);
    }




}


for (const vide of box) { //créer un event pour tout les élément de box

    vide.addEventListener('dragover', dragOverp); //event: lorsqu'on est en train de drag

    vide.addEventListener('dragenter', dragEnterp); //event: lorsqu'on est entré dans une zone ou on peut drop

    vide.addEventListener('dragleave', dragLeavep); //event: lorsqu'on quitte une zone de drop

    vide.addEventListener('drop', dragDropp); //event: lorsqu'on drop l'item


}



function dragOverp(e) {
    e.preventDefault(); //retire l'action par default de dragOver qu'on ne veut pas

}

function dragEnterp(e) {
    if (now === 'p') {

        e.preventDefault(); //retire l'action par default de dragEnter qu'on ne veut pas

        if (this === trackp[1]) { //Retirer élément

            securitep = false;
            trackp[0].classList.remove("p");
            trackp[0].className += ' unused';
            lvlp = parseInt(trackp[1].id);
            trackp[0].setAttribute('draggable', false);
            trackp.shift();
            dragEnterp(e);
        } else if ((trackp.indexOf(this) === -1) && securitep) {
            let voisinp = false;
            if (this.classList.contains('unused')) {
                if (lvlp <= parseInt(this.id)) {
                    if (this.cellIndex - 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex - 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex - 1] === document.getElementById("tableau").rows[trackp[0].parentNode.rowIndex].cells[trackp[0].cellIndex]) {
                            voisinp = true;

                        }
                    }
                    if (this.cellIndex + 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex + 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex + 1] === document.getElementById("tableau").rows[trackp[0].parentNode.rowIndex].cells[trackp[0].cellIndex]) {
                            voisinp = true;

                        }
                    }
                    if (this.parentNode.rowIndex - 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex - 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex - 1].cells[this.cellIndex] === document.getElementById("tableau").rows[trackp[0].parentNode.rowIndex].cells[trackp[0].cellIndex]) {
                            voisinp = true;

                        }
                    }
                    if (this.parentNode.rowIndex + 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex + 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex + 1].cells[this.cellIndex] === document.getElementById("tableau").rows[trackp[0].parentNode.rowIndex].cells[trackp[0].cellIndex]) {
                            voisinp = true;

                        }
                    }
                    if (voisinp === true) {
                        ajoutp++;
                        next_tourp = false;
                        this.className += ' p'; //ajoute la class 'r' à l'objet actuel
                        this.classList.remove("unused");
                        lastp = this;
                        lvlp = parseInt(this.id);
                        trackp[0].setAttribute('draggable', false);
                        trackp.unshift(this);
                        trackp[0].setAttribute('draggable', true);
                    }
                }
            }
        } else if (!securitep) {
            securitep = true;
        }
    }


}



function dragLeavep() {
    if (now === 'p') {

        if (trackp.length === 2 && ajoutp === 0) {
            trackp[0].classList.remove("p");
            trackp[0].className += ' unused';
            trackp[0].setAttribute('draggable', false);
            startp.setAttribute('draggable', true);
            trackp.shift();
            lvlp = 1;
            ajoutp = -1;
        } else if (next_tourp) {
            trackp[0].classList.remove("p");
            trackp[0].className += ' unused';
            trackp[0].setAttribute('draggable', false);
            startp.setAttribute('draggable', true);
            trackp.shift();
            lvlp = 1;
            ajoutp = -1;
            next_tourp = false;

        }
        if (trackp.length === 2) {
            next_tourp = true;
        }


        if (trackp.length === 1) {
            startp.setAttribute('draggable', true);
            blocker = false;
        }

        if (this.classList.contains("case")) {} else {
            this.className += ' case'; //définie la class de l'objet actuel à ' case'
        }
    }





}



function dragDropp() {

    if (trackp.length !== 1) {
        trackp[0].setAttribute('draggable', true);
    } else {
        startp.setAttribute('draggable', true);
    }

    //this.className += 'case'; //définie la class de l'objet actuel à ' case'
    //this.append(red); //change la position de la base à l'élément actuel
}

function clearp(){
    const caseliste = document.querySelectorAll('.p');
    if(caseliste !== null){
        for (let i = 0; i < caseliste.length; i++) {
            caseliste[i].classList.remove('p');
            caseliste[i].className += " unused";
            caseliste[i].setAttribute('draggable', false);
        }
        lvlp = 1;
        trackp = [];
        trackp.unshift(startp);
        blocker = false;
        startp.className += ' p';
        startp.setAttribute('draggable', true);
        startp.classList.remove('unused');
    }

}