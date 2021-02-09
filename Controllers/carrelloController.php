<?php

    require "../PDO/database.php";
    require "../include/template2.inc.php";
    require "../Data/user.php";
    require "../Data/carrello.php";
	require "../Data/immagine.php";
    require "../Data/prodotto.php";

    $main = new Template("../dtml/checkoutLogInd.html");
    $card = new Template("../dtml/index.html"); //pagina comune

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    $carrello = new Carrello($db);
    $prodotto = new Prodotto($db);
    $images = new Immagine($db);


    $id_user = $user->getUser($_SESSION['user_id']);

    
    if($id_user != 0){
        $cart = $carrello->viewCart($id_user);
    } else{
        callErrorTemplate($msg);
    }


    function callErrorTemplate($errore){
        $error = new Template("../dtml/error.html");
        $error->setContent("msgError", $errore);
        $error->close();
    }

    $quant = $carrello->getQuantita($_SESSION['quantita']);
    //funzione per calcolo prezzo singolo prodotto in base alla quantità
    //funzione per calcolo prezzo totale

    $main->close();

?>
