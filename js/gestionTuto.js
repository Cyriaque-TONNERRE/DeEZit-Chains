function closeTuto() {
    document.querySelector('.tuto').classList.add('disparition');
    document.getElementById('tableau').classList.remove('disparition');
    document.getElementById('back').style.filter= "blur(0)";
    document.getElementById('score').style.filter= "blur(0)";
    document.getElementById('reset').style.filter= "blur(0)";
    document.getElementById('export_button').style.filter= "blur(0)";
}