<?php 
		session_start(); //D�marrer la session
	if(isset($_COOKIE["username"])){ // si un utilisateur est authentifi�
		setcookie("username","",0);
		header("Location:login.php");
	}
?>