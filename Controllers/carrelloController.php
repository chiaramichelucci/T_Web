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

    if($user->id != 0){
        $cart = $carrello->getByUserId($user->id);
        $id = print_r($data['id'], true);
        $img = $images->getByProdId($id);
    }

    //sezione di controllo per quantita' e prezzo

    $main->close();

?>
