<?php 
session_start(); //D�marrer la session
if(isset($_SESSION["username"])){ // si un utilisateur est authentifi�
    session_destroy(); // on d�truit la session
}
header("Location: index.php"); // on redirige vers la page d'accueil
?>