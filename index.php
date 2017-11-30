<?php
session_start();

require "model/model.php";

//if (isset($_SESSION["user_id"])) {

	$produits = listeProduits();

	if (isset($_POST["ajouter_panier"])) {

	    ajouterPanier(1, $_POST["article_id"]);

	}

	require "view/produits.html.php";
/*}
else {

	require "view/login.html.php";
	
}*/
