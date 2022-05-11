<?php 
		session_start(); //Démarrer la session
	if(isset($_COOKIE["username"])){ // si un utilisateur est authentifié
		setcookie("username","",-1);
		header("Location:login.php");
	}
?>