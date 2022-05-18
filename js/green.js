//const red = document.querySelector('.r'); //variable qui recup la base
const green = document.querySelector('.g'); //variable qui recup la base
//const box = document.querySelectorAll('.case'); //variable qui recup toutes les cases
let lvlg = 1;
let trackg = [];
startg = document.querySelector('.g');
trackg.unshift(startg);
securiteg = true;
next_tourg = false;
ajoutg = -1;
now = 0;



//red.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
//red.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd
green.addEventListener('dragstart', dragStartg); //event: lorsqu'on commence a drag appel la fonction dragStart
green.addEventListener('dragend', dragEndg); //event: lorsqu'on lache l'objet appel la fonction dargEnd
green.addEventListener('drag', drag);

function dragStartg() { // FONCTION dragStart
    
    this.className += ' tenu'; //ajoute la class 'tenu' à l'objet actuel
    lastg = this;
    now = 'g';
    blocker = true;

    //setTimeout(() => (this.className = 'invisible'), 0); //permet de rendre l'objet invisible lorsqu'on drag sinon il reste afficher à son ancienne pos
}

function dragEndg() { //FONCTION dragEnd
    //this.className = 'base'; //define la class de l'objet actuel a 'base'
    this.classList.remove("tenu");
    if (trackg.length === 1) {
        this.setAttribute('draggable', true);
    } else {
        this.setAttribute('draggable', false);
    }




}


for (const vide of box) { //créer un event pour tout les élément de box

    vide.addEventListener('dragover', dragOverg); //event: lorsqu'on est en train de drag

    vide.addEventListener('dragenter', dragEnterg); //event: lorsqu'on est entré dans une zone ou on peut drop

    vide.addEventListener('dragleave', dragLeaveg); //event: lorsqu'on quitte une zone de drop

    vide.addEventListener('drop', dragDropg); //event: lorsqu'on drop l'item


}



function dragOverg(e) {
    e.preventDefault(); //retire l'action par default de dragOver qu'on ne veut pas

}

function dragEnterg(e) {
    if (now === 'g') {
        e.preventDefault(); //retire l'action par default de dragEnter qu'on ne veut pas

        if (this === trackg[1]) { //Retirer élément

            securiteg = false;
            trackg[0].classList.remove("g");
            trackg[0].className += ' unused';
            lvlg = parseInt(trackg[1].id);
            trackg[0].setAttribute('draggable', false);
            trackg.shift();
            dragEnterg(e);
        } else if ((trackg.indexOf(this) === -1) && securiteg) {
            let voising = false;
            if (this.classList.contains('unused')) {
                if (lvlg <= parseInt(this.id)) {
                    if (this.cellIndex - 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex - 1 >= 0) {
                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex - 1] === document.getElementById("tableau").rows[trackg[0].parentNode.rowIndex].cells[trackg[0].cellIndex]) {
                            voising = true;

                        }
                    }
                    if (this.cellIndex + 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex + 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex + 1] === document.getElementById("tableau").rows[trackg[0].parentNode.rowIndex].cells[trackg[0].cellIndex]) {
                            voising = true;

                        }
                    }
                    if (this.parentNode.rowIndex - 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex - 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex - 1].cells[this.cellIndex] === document.getElementById("tableau").rows[trackg[0].parentNode.rowIndex].cells[trackg[0].cellIndex]) {
                            voising = true;

                        }
                    }
                    if (this.parentNode.rowIndex + 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex + 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex + 1].cells[this.cellIndex] === document.getElementById("tableau").rows[trackg[0].parentNode.rowIndex].cells[trackg[0].cellIndex]) {
                            voising = true;

                        }
                    }
                    if (voising === true) {
                        ajoutg++;
                        next_tourg = false;
                        this.className += ' g'; //ajoute la class 'r' à l'objet actuel
                        this.classList.remove("unused");
                        lastg = this;
                        lvlg = parseInt(this.id);
                        trackg[0].setAttribute('draggable', false);
                        trackg.unshift(this);
                        trackg[0].setAttribute('draggable', true);

                    }
                }
            }
        } else if (!securiteg) {
            securiteg = true;
        }
    }


}



function dragLeaveg() {
    if (now === 'g') {

        if (trackg.length === 2 && ajoutg === 0) {
            trackg[0].classList.remove("g");
            trackg[0].className += ' unused';
            trackg[0].setAttribute('draggable', false);
            startg.setAttribute('draggable', true);
            trackg.shift();
            lvlg = 1;
            ajoutg = -1;
        } else if (next_tourg) {
            trackg[0].classList.remove("g");
            trackg[0].className += ' unused';
            trackg[0].setAttribute('draggable', false);
            startg.setAttribute('draggable', true);
            trackg.shift();
            lvlg = 1;
            ajoutg = -1;
            next_tourg = false;

        }
        if (trackg.length === 2) {
            next_tourg = true;
        }


        if (trackg.length === 1) {
            startg.setAttribute('draggable', true);
            blocker = false;
            secublocker = true;
        }
        else{
            secublocker = false;
        }

        if (this.classList.contains("case")) {} else {
            this.className += ' case'; //définie la class de l'objet actuel à ' case'
        }




    }
}



function dragDropg() {

    if (trackg.length !== 1) {
        trackg[0].setAttribute('draggable', true);
    } else {
        startg.setAttribute('draggable', true);
    }

    //this.className += 'case'; //définie la class de l'objet actuel à ' case'
    //this.append(red); //change la position de la base à l'élément actuel
}