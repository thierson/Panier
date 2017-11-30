 <?php

function initDatabase() {
	try {
	  require "config.php";

	  $pdo = new PDO(
	    "mysql:dbname=$dbname;host=$host;charset=utf8", $user, $password
	  );
	} catch (PDOException $e) {
	  echo 'erreur : ' . $e->getMessage();

	  $pdo = null;
	}

	return $pdo;
}


function prepareStatement($sql) {
	$pdo_statement = null;

	$pdo = initDatabase();

	if ($pdo) {
		try {

		  $pdo_statement = $pdo->prepare($sql);

		} catch (PDOException $e) {

		  echo 'erreur : ' . $e->getMessage();

		}
	}

	return $pdo_statement;
}


function listeProduits() {


    $sql = "SELECT * FROM articles";

    $pdo_statement = prepareStatement($sql);


    try {

        $pdo_statement->execute();

        $produits = $pdo_statement->fetchAll();

    } catch (PDOException $e) {


        echo 'erreur : ' . $e->getMessage();

    }

    return $produits;

}


function ajouterPanier($user_id, $article_id) {


    $sql = "INSERT INTO cart (user_id, article_id, nb) VALUES (:user_id, :article_id, 1)";

    $pdo_statement = prepareStatement($sql);


    try {

        $pdo_statement->bindParam(":user_id", $user_id);
        $pdo_statement->bindParam(":article_id", $article_id);

        $pdo_statement->execute();

    } catch (PDOException $e) {


        echo 'erreur : ' . $e->getMessage();

    }

    return $pdo_statement;

}


function listeProduitsPanier($user_id) {

    $sql = "SELECT * FROM cart INNER JOIN articles ON articles.id = cart.article_id WHERE user_id = :user_id ";

    $pdo_statement = prepareStatement($sql);


    try {

        $pdo_statement->bindParam(":user_id", $user_id);

        $pdo_statement->execute();

        $produits = $pdo_statement->fetchAll();

    } catch (PDOException $e) {


        echo 'erreur : ' . $e->getMessage();

    }

    return $produits;

}


function supprimerDuPanier($user_id, $article_id) {



    $sql = "DELETE FROM cart WHERE user_id = :user_id AND article_id = :article_id";

    $pdo_statement = prepareStatement($sql);


    try {

        $pdo_statement->bindParam(":user_id", $user_id);
        $pdo_statement->bindParam(":article_id", $article_id);

        $pdo_statement->execute();

    } catch (PDOException $e) {


        echo 'erreur : ' . $e->getMessage();

    }

    return $pdo_statement;



}


function addOne($user_id, $article_id) {

    $sql = "UPDATE cart SET nb = nb + 1 WHERE user_id = :user_id AND article_id = :article_id";

    $pdo_statement = prepareStatement($sql);

    try {

        $pdo_statement->bindParam(":user_id", $user_id);
        $pdo_statement->bindParam(":article_id", $article_id);

        $pdo_statement->execute();

    } catch (PDOException $e) {


        echo 'erreur : ' . $e->getMessage();

    }

    return $pdo_statement;

}


function subOne($user_id, $article_id) {

    $sql = "UPDATE cart SET nb = nb - 1 WHERE user_id = :user_id AND article_id = :article_id";

    $pdo_statement = prepareStatement($sql);

    try {

        $pdo_statement->bindParam(":user_id", $user_id);
        $pdo_statement->bindParam(":article_id", $article_id);

        $pdo_statement->execute();

    } catch (PDOException $e) {


        echo 'erreur : ' . $e->getMessage();

    }

    return $pdo_statement;

}

function supprimerLePanier($user_id) {
     $sql = "DELETE FROM cart WHERE user_id = :user_id";

    $pdo_statement = prepareStatement($sql);

    try {

        $pdo_statement->bindParam(":user_id", $user_id);

        $pdo_statement->execute();

    } catch (PDOException $e) {


        echo 'erreur : ' . $e->getMessage();

    }

    return $pdo_statement;


}

function login($mail, $password) {
    $sql = "SELECT * FROM users WHERE email = :mail, AND mdp = password";

     $pdo_statement = prepareStatement($sql);

    try {

        $pdo_statement->bindParam(":mail", $mail);
        $pdo_statement->bindParam(":mdp", $password);

        $pdo_statement->execute();

        $result = $pdo_statement->fetchAll();

        if ($result[0]["id"] > 0) {
            $userConnected = $result[0]["id"];
            
        } else {
            $userConnected = false;

        }

    } catch (PDOException $e) {


        echo 'erreur : ' . $e->getMessage();

    }

    return $userConnected;
}
