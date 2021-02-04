<?php

    require "../PDO/database.php";
    require "../include/template2.inc.php";
	require "../Data/immagine.php";
    require "../Data/prodotto.php";
    require "../Data/lotto.php";
    require "../Data/produttore.php";
    require "../Data/recensione.php";
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

    $id_prod = $prod->getProdotto($_SESSION['prodotto_id']);

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

    $recens = $rec -> getByProdId($id);
    $numRec = $rec->rowCount();
    if($numRec>0){  //fai un foreach per stampare i review perche puo darsi che sono di piu
        //numRec>0 serve per vedere se il db ha qualche review per un datto prodotto se non ha niente allora non stampa niente
		$dataRec = $rec->fetch(PDO::FETCH_ASSOC);
		$card->setContent("recensione", $dataRec['recensione_prodotto']);
    } 
    //voglio visualizzare le recensioni sotto forma di griglia 
    //(titolo con stelle e sotto commento)

    $dn = $dettN->getDettagliN($_SESSION['prodotto_id']);
    //voglio visualizzare i dettagli nutrizionali sotto forma di tabella
    //qua devi prendere il result set dalla querry e fare nometemplate->setContent("nometag", $var) per ogni 

    //seleziono l'id del produttore dalla tabella prodotto
    //e prendo il link del sito
    //implementare le funzioni dentro produttore e PDO per fare la query per ottenere queste


    $main->close();
?>