<?php

    require "../PDO/database.php";
    require "../include/template2.inc.php";
    require "../Data/user.php";
    require "../Data/prodottoInOrdine.php";
    require "../Data/Ordine.php";
    require "../Data/infoPagamento.php";
    require "../Data/infoSpedizione.php";

    $main = new Template("../dtml/riepilogoOrdine.html");
    $card = new Template("../dtml/index.html"); //pagina comune

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    $ordine = new Ordine($db);
    $p_ordine = new ProdottoInOrdine($db);
    $infoP = new InfoSpedizione($db);
    $infoS = new InfoPagamento($db);

    $prod = $p_ordine->getProdottoInOrdine($_SESSION['id_prodotto']);
    $qta = $p_ordine->getProdottoInOrdine($_SESSION['quantita']);
    $prezzo = $ordine-> getByProdId($prod); //prendere il prezzo del singolo prodotto
    $paga = $infoP->getInfoPagamento($_SESSION['id_ordine']); //prendere solo la modalità di pagamento
    $data = $infoS->getInfoSpedizione($_SESSION['id_ordine']);

    $main->close();

?>