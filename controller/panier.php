<?php
require "../model/model.php";



if (isset($_POST["supprimer_du_panier"])) {
    
  supprimerDuPanier(1, $_POST["article_id"]);
    
} else if (isset($_POST["add_one"])) {
    
    addOne(1, $_POST["article_id"]);
    
} else if (isset($_POST["sub_one"])) {
    
    
    subOne(1, $_POST["article_id"]);
    
}

else if (isset($_POST["Supprimer_le_panier"])) {
	supprimerLePanier(1);

}



$produits = listeProduitsPanier(1);

require "../view/panier.html.php";

?>