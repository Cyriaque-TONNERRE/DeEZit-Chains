<?php 
		session_start(); //Démarrer la session
	if(isset($_COOKIE["username"])){ // si un utilisateur est authentifié
		setcookie("username","",0);
		header("Location:login.php");
	}
?>