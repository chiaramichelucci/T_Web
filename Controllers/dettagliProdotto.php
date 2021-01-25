<?php

    require "../PDO/database.php";
    require "../include/template2.inc.php";
	require "../Data/immagine.php";
    require "../Data/prodotto.php";
    require "../Data/lotto.php";
    require "../Data/produttore.php";
    require "../Data/Recensione.php";
    require "../Data/dettagliNutrizionali.php";

    $main = new Template("../dtml/singoloProdotto.html");
    //$card = new Template("../dtml/products.html");

    $database = new Database();
    $db = $database->getConnection();
    $prodotto = new Prodotto($db);
    $images = new Immagine($db);
    $lotto = new Lotto($db);
    $prod = new Produttore($db);
    $rec = new Recensione($db);
    $dettN = new DettagliNutrizionali($db);

    $id = print_r($data['id'], true);

	$img = $images->getByProdId($id);
	$numImg = $img->rowCount();
	if($numImg>0){
		$dataImg = $img->fetch(PDO::FETCH_ASSOC);
		$card->setContent("url", $dataImg['url_prod_img']);
	} else {
		$card->setContent("url", "../dtml/images/imgmissing.png");
	}
	foreach($data as $key => $value) {
		$card->setContent($key, $value);
	}
    
    $lot = $lotto -> getByProdId($id);

    $recens = $rec -> getByProdId($id);
    $numRec = $rec->rowCount();
	if($numRec>0){
		$dataRec = $rec->fetch(PDO::FETCH_ASSOC);
		$card->setContent("recensione", $dataRec['recensione_prodotto']);
    } 
    //voglio visualizzare le recensioni sotto forma di griglia 
    //(titolo con stelle e sotto commento)

    $dn = $dettN -> getByProdId($id);
    //voglio visualizzare i dettagli nutrizionali sotto forma di tabella

    //seleziono l'id del produttore dalla tabella prodotto
    //e prendo il link del sito
    $produttore = print_r($data['id_produttore'], true);
    $link = $prod -> getByProdId($produttore);

    $main->close();
?>