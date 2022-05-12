const base = document.querySelector('.base'); //variable qui recup la base
const box = document.querySelectorAll('.case'); //variable qui recup toutes les cases



base.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
base.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd


function dragStart() { // FONCTION dragStart
    this.className += ' tenu'; //ajoute la class 'tenu' à l'objet actuel

    setTimeout(() => (this.className = 'invisible'), 0); //permet de rendre l'objet invisible lorsqu'on drag sinon il reste afficher à son ancienne pos
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
    this.className += ' hovered'; //ajoute la class hovered à l'objet actuel
    //this.id += ' entered'
    console.log(this.id);
    /*if (textContent != "add") {
        this.append("add"); //ajout add dans la div actuel
        console.log("ajouter");
    } else console.log("non");*/
}


function dragLeave() {
    this.className = 'case'; //définie la class de l'objet actuel à ' case'
}


function dragDrop() {
    this.className = 'case'; //définie la class de l'objet actuel à ' case'
    this.append(base); //change la position de la base à l'élément actuel
}