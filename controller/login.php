<?php
 
require "../model/model.php";
if (isset($_POST["login"])) {

	# fonction qui permet de savoir si le mail et le mdps estr bon q'uil returen true si c'est bon 
	$userConnected = login($_POST["mail"], $_POST["password"]);

	if ($userConnected) {

	 //il faut s'assurer qu'il n'ya pas de session ouverte, sinon détruire toute les variables de session et fermer la session
		session_start();

		$_SESSION["user_id"] = $userConnected;
		header('location: ./index.php');

	 } else {
 	unset($_SESSION);
 	session_destroy();

 	header('location: ../index.php');

 } 

}

 