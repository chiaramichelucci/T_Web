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
        $id_prodotto = $carrello->getProdotto($id_user);
        $prezzo = $prodotto->getPrezzoP($id_prodotto);
    } else{
        callErrorTemplate($msg);
    }


    function callErrorTemplate($errore){
        $error = new Template("../dtml/error.html");
        $error->setContent("msgError", $errore);
        $error->close();
    }

    $quant = $carrello->getQuantita($_SESSION['quantita']);


    $somma = 0;
    result_set = getCarrello($id_user);
    while(result_set->fetch){​​
        prod_id = result_set(id_prodotto)
        result_set2 = getProdotto($id_prodotto)
        result_set2->fetch(prezzo)
        $somma = $somma + result_set2(prezzo)
    }


    $main->close();

?>
