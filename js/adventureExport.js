function download(filename, textInput) {

    var element = document.createElement('a');
    element.setAttribute('href','data:text/plain;charset=utf-8, ' + encodeURIComponent(textInput));
    element.setAttribute('download', filename);
    document.body.appendChild(element);
    element.click();
    //document.body.removeChild(element);
}

filename = "niveauExporter";
document.getElementById("namelvl").oninput = function () {
    filename = document.getElementById("namelvl").value;
}



function exporter(size){

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
    console.log(parseInt(size));
    const lescases = document.querySelectorAll(".tab");
    for (trous of lescases) {
        if(trous.id.toString() === 0 || trous.id.toString() === '0'){

            if(trous.classList.contains('r')){
                Fexporter.level[j] += 'r'.toString();
            }
            else if(trous.classList.contains('g')){
                Fexporter.level[j] += 'g'.toString();
            }
            else if(trous.classList.contains('b')){
                Fexporter.level[j] += 'b'.toString();
            }
            else if(trous.classList.contains('p')){
                Fexporter.level[j] += 'p'.toString();
            }
            else if(trous.classList.contains('y')){
                Fexporter.level[j] += 'y'.toString();
            }
            else{
                Fexporter.level[j] += trous.id.toString();
            }
        }
        else{
         Fexporter.level[j] += trous.id.toString();
        }
        i++;
        if (i === parseInt(size)) {
            const tmp = Fexporter.level[j];
            Fexporter.level[j] = tmp.substring(9);
            i = 0;
            j++;
        }
    }

    

    document.getElementById("exportationLvl").classList.remove('disparition');
    document.getElementById("export_button").classList += ' disparition';
    document.getElementById("game").classList += ' disparition';
    document.getElementById("reset").classList += ' disparition';
    document.getElementById("score").classList += ' disparition';
    
    


}

function closeExporter() {
    document.getElementById("exportationLvl").classList += ' disparition';
    document.getElementById("export_button").classList.remove('disparition');
    document.getElementById("game").classList.remove('disparition');
    document.getElementById("score").classList.remove('disparition');
    document.getElementById("reset").classList.remove('disparition');

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

