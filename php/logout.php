<?php 
		session_start(); //D�marrer la session
	if(isset($_SESSION['ID'])){ // si un utilisateur est authentifi�
		session_unset(); //d�truire les variable
		session_destroy();//d�truire la session
		header("Location:login.php");
	}
?>