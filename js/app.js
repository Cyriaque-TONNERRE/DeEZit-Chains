const red = document.querySelector('.r'); //variable qui recup la base
const green = document.querySelector('.g'); //variable qui recup la base
const box = document.querySelectorAll('.case'); //variable qui recup toutes les cases



red.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
red.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd
green.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
green.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd

function dragStart() { // FONCTION dragStart
    this.className += ' tenu'; //ajoute la class 'tenu' à l'objet actuel

    //setTimeout(() => (this.className = 'invisible'), 0); //permet de rendre l'objet invisible lorsqu'on drag sinon il reste afficher à son ancienne pos
}

function dragEnd() { //FONCTION dragEnd
    this.className = 'base'; //define la class de l'objet actuel a 'base'
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
    //this.id += 'r2'; //ajoute la class 'r2' à l'objet actuel
    console.log(this.id);
}


function dragLeave() {
    this.className += 'case'; //définie la class de l'objet actuel à ' case'
}


function dragDrop() {
    this.className += 'case'; //définie la class de l'objet actuel à ' case'
    //this.append(red); //change la position de la base à l'élément actuel
}