const red = document.querySelector('.r'); //variable qui recup la base
//const green = document.querySelector('.g'); //variable qui recup la base
const box = document.querySelectorAll('.case'); //variable qui recup toutes les cases
const mouse = document.querySelector('tableau');
red.addEventListener("click", clearr);
lvlr = 1;
trackr = [];
startr = document.querySelector('.r');
trackr.unshift(startr);
securiter = true;
next_tourr = false;
ajoutr = -1;
blocker = false;
let delta = null;
let posx = 0;
let posy = 0;
indice=Number(getCookie("time_lvl")) ;

red.addEventListener('drag', drag);
red.addEventListener('dragstart', dragStartr); //event: lorsqu'on commence a drag appel la fonction dragStart
red.addEventListener('dragend', dragEndr); //event: lorsqu'on lache l'objet appel la fonction dargEnd
//green.addEventListener('dragstart', dragStart); //event: lorsqu'on commence a drag appel la fonction dragStart
//green.addEventListener('dragend', dragEnd); //event: lorsqu'on lache l'objet appel la fonction dargEnd

function dragStartr(e) { // FONCTION dragStart
    // posxr = e.clientX;
    // posyr = e.clientY;
    this.className += ' tenu'; //ajoute la class 'tenu' à l'objet actuel
    now = 'r';
    lastr = this;
    blocker = true;



    //setTimeout(() => (this.className = 'invisible'), 0); //permet de rendre l'objet invisible lorsqu'on drag sinon il reste afficher à son ancienne pos
}

function dragEndr(e) { //FONCTION dragEnd
    //this.className = 'base'; //define la class de l'objet actuel a 'base'
    if (trackr.length === 1) {
        this.setAttribute('draggable', true);
    } else {
        this.setAttribute('draggable', false);
    }




}


for (const vide of box) { //créer un event pour tout les élément de box

    vide.addEventListener('dragover', dragOverr); //event: lorsqu'on est en train de drag

    vide.addEventListener('dragenter', dragEnterr); //event: lorsqu'on est entré dans une zone ou on peut drop

    vide.addEventListener('dragleave', dragLeaver); //event: lorsqu'on quitte une zone de drop

    vide.addEventListener('drop', dragDrop); //event: lorsqu'on drop l'item

    vide.addEventListener('drag', drag);
}

function drag(e) {
    delta = { x: posx - e.clientX, y: posy - e.clientY };
    posx = e.clientX;
    posy = e.clientY;
    if (!blocker) {
        if (this.classList.contains('r')) {
            now = 'r';
            blocker = true;
        } else if (this.classList.contains('b')) {
            now = 'b';
            blocker = true;
        } else if (this.classList.contains('g')) {
            now = 'g';
            blocker = true;
        } else if (this.classList.contains('p')) {
            now = 'p';
            blocker = true;
        } else if (this.classList.contains('y')) {
            now = 'y';
            blocker = true;
        }
    }
}

function dragOverr(e) {

    e.preventDefault(); //retire l'action par default de dragOver qu'on ne veut pas




}

function dragEnterr(e) {
    if (!((delta.x > -2 && delta.x < 2) && (delta.y > -2 && delta.y < 2)) && !blocker) { //Tentative anti agression nucléaire
        //Revoir ici
        console.log("append");
        dragDrop(e);
        return 0;
    }

    if (now === 'r') {
        e.preventDefault(); //retire l'action par default de dragEnter qu'on ne veut pas


        if (this === trackr[1]) { //Retirer élément

            securiter = false;
            trackr[0].classList.remove("r");
            trackr[0].className += ' unused';
            lvlr = parseInt(trackr[1].id);
            trackr[0].setAttribute('draggable', false);
            trackr.shift();
            dragEnterr(e);
        } else if ((trackr.indexOf(this) === -1) && securiter) {
            let voisinr = false;
            if (this.classList.contains('unused')) {
                if (lvlr <= parseInt(this.id)) {
                    if (this.cellIndex - 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex - 1 >= 0) { //cell - 1

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex - 1] === document.getElementById("tableau").rows[trackr[0].parentNode.rowIndex].cells[trackr[0].cellIndex]) {
                            voisinr = true;

                        }
                    }
                    if (this.cellIndex + 1 < (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells.length) && this.cellIndex + 1 >= 0) { //cel + 1

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex].cells[this.cellIndex + 1] === document.getElementById("tableau").rows[trackr[0].parentNode.rowIndex].cells[trackr[0].cellIndex]) {
                            voisinr = true;

                        }
                    }
                    if (this.parentNode.rowIndex - 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex - 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex - 1].cells[this.cellIndex] === document.getElementById("tableau").rows[trackr[0].parentNode.rowIndex].cells[trackr[0].cellIndex]) {
                            voisinr = true;

                        }
                    }
                    if (this.parentNode.rowIndex + 1 < (document.getElementById("tableau").rows.length) && this.parentNode.rowIndex + 1 >= 0) {

                        if (document.getElementById("tableau").rows[this.parentNode.rowIndex + 1].cells[this.cellIndex] === document.getElementById("tableau").rows[trackr[0].parentNode.rowIndex].cells[trackr[0].cellIndex]) {
                            voisinr = true;

                        }
                    }
                    if (voisinr === true) {
                        ajoutr++;
                        next_tourr = false;
                        this.className += ' r'; //ajoute la class 'r' à l'objet actuel
                        this.classList.remove("unused");
                        lastr = this;
                        lvlr = parseInt(this.id);
                        trackr[0].setAttribute('draggable', false);
                        trackr.unshift(this);
                        trackr[0].setAttribute('draggable', true);
                    }
                }
            }
        } else if (!securiter) {
            securiter = true;
        }

    }

}



function dragLeaver() {
    if (now === 'r') {

        if (trackr.length === 2 && ajoutr === 0) {
            trackr[0].classList.remove("r");
            trackr[0].className += ' unused';
            trackr[0].setAttribute('draggable', false);
            startr.setAttribute('draggable', true);
            trackr.shift();
            lvlr = 1;
            ajoutr = -1;
        } else if (next_tourr) {
            trackr[0].classList.remove("r");
            trackr[0].className += ' unused';
            trackr[0].setAttribute('draggable', false);
            startr.setAttribute('draggable', true);
            trackr.shift();
            lvlr = 1;
            ajoutr = -1;
            next_tourr = false;

        }
        if (trackr.length === 2) {
            next_tourr = true;
        }


        if (trackr.length === 1) {
            startr.setAttribute('draggable', true);
            blocker = false;
        }


        if (this.classList.contains("case")) {} else {
            this.className += ' case'; //définie la class de l'objet actuel à ' case'
        }
    }
    if (document.querySelector('.unused') === null) {
        //Victoire

        var URL = window.location.href;
        if (URL.includes("affichage_history.php")) {
            number = URL.substring(URL.indexOf('=') + 1);
            document.cookie = `id=${number}; expires=${new Date(new Date().getTime() + 2000).toUTCString()}; path=/`;
            document.location.href = "redirect.php?id=" + number;
        } 
        else if(URL.includes("importgame.php")){
            document.location.href = "create.php";

        }
        else if(URL.includes("time.php")){
            function redirectPost(url, data) {
                var form = document.createElement('form');
                document.body.appendChild(form);
                form.method = 'post';
                form.action = url;
                for (var name in data) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    input.value = data[name];
                    form.appendChild(input);
                }
                form.submit();
            }
   

            redirectPost('time.php',document.getElementById("minuteur").innerHTML);

        }
        else {
            document.cookie = `valid=true; expires=${new Date(new Date().getTime() + 500).toUTCString()}; path=/`;
            document.location.href = "adventure.php";
            
        }
    }





}



function dragDrop() {
    if (trackr.length !== 1) {
        trackr[0].setAttribute('draggable', true);
    } else {
        startr.setAttribute('draggable', true);
    }
    blocker = false;

    if(document.querySelector('.unused') === null){
        //Victoire
        var URL = window.location.href;
        var URL = window.location.href;
        if (URL.includes("affichage_history.php")) {
            number = URL.substring(URL.indexOf('=') + 1);
            document.cookie = `id=${number}; expires=${new Date(new Date().getTime() + 2000).toUTCString()}; path=/`;
            document.location.href = "redirect.php?id=" + number;
        } 
        else if(URL.includes("importgame.php")){
            document.location.href = "create.php";

        }
        else if(URL.includes("time.php")){
            function redirectPost(url, data) {
                var form = document.createElement('form');
                document.body.appendChild(form);
                form.method = 'post';
                form.action = url;
                for (var name in data) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    input.value = data[name];
                    form.appendChild(input);
                }
                form.submit();
            }
   

            redirectPost('time.php',document.getElementById("minuteur").innerHTML);

        }
        else {
            document.cookie = `valid=true; expires=${new Date(new Date().getTime() + 500).toUTCString()}; path=/`;
            document.location.href = "adventure.php";
            
        }
    }
}

    //this.className += 'case'; //définie la class de l'objet actuel à ' case'
    //this.append(red); //change la position de la base à l'élément actuel


function clearr() {
    const caseliste = document.querySelectorAll('.r');
    if (caseliste !== null) {
        for (let i = 0; i < caseliste.length; i++) {
            caseliste[i].classList.remove('r');
            caseliste[i].className += " unused";
            caseliste[i].setAttribute('draggable', false);
        }
        lvlr = 1;
        trackr = [];
        trackr.unshift(startr);
        blocker = false;
        startr.className += ' r';
        startr.classList.remove('unused');
        startr.setAttribute('draggable', true);
    }

}