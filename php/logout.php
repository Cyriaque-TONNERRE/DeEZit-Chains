<?php 
		session_start(); //Démarrer la session
	if(isset($_SESSION['ID'])){ // si un utilisateur est authentifié
		session_unset(); //détruire les variable
		session_destroy();//détruire la session
		header("Location:login.php");
	}
?>