<?php

    require "../PDO/database.php";
    require "../include/template2.inc.php";
	require "../Data/immagine.php";
    require "../Data/prodotto.php";
    require "../Data/lotto.php";
    require "../Data/produttore.php";
    require "../Data/recensione.php";
    require "../Data/dettagliNutrizionali.php";

    session_start();
	$checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['group']) && !empty($_SESSION['group']) && $_SESSION['group'] == 1){
			$bar = new Template("../dtml/userBarAdmin.html");
		} elseif(isset($_SESSION['group']) && !empty($_SESSION['group']) && $_SESSION['group'] == 2){
            $bar = new Template("../dtml/userBarGeneric.html");
        }else{
            $bar = new Template("../dtml/userBarUnsigned.html");
        }
    }else{
        $bar = new Template("../dtml/userBarUnsigned.html");
    }

    $main = new Template("../dtml/singoloProdotto.html");
    $error = new Template("../dtml/error.html");
    $main->setContent("userbar", $bar->get());
    //$card = new Template("../dtml/products.html");

    $database = new Database();
    $db = $database->getConnection();
    $prodotto = new Prodotto($db);
    $images = new Immagine($db);
    $lotto = new Lotto($db);
    $produttore = new Produttore($db);
    $prod = new Prodotto($db);
    $rec = new Recensione($db);
    $dettN = new DettagliNutrizionali($db);

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $prod->getProdotto($_GET['id']);
    } else {
        $error->setContent("msgErrore", "Nessun id");
        $error->close();
    }

    if($prod->id == 0){
        $error->setContent("msgErrore", "Nessuno prodotto con quello id");
        $error->close();
    }else{
        $main->setContent("nome", $prod->nome);
        $main->setContent("prezzo", $prod->prezzo);
        $main->setContent("descrizione", $prod->descrizione);
    }

	$img = $images->getByProdId($prod->id);
	$numImg = $img->rowCount();
	if($numImg>0){
		$dataImg = $img->fetchAll(PDO::FETCH_ASSOC);
        foreach($dataImg as $key){
            $main->setContent("url_prod_img", $key['url_prod_img']);
        }
	} else {
		$main->setContent("url_prod_img", "../dtml/images/imgmissing.png");
	}

    $recens = $rec -> getRecensione($prod->id);
    $numRec = $recens->rowCount();
    if($numRec>0){  //fai un foreach per stampare i review perche puo darsi che sono di piu
        //numRec>0 serve per vedere se il db ha qualche review per un datto prodotto se non ha niente allora non stampa niente
		$dataRec = $recens->fetchAll(PDO::FETCH_ASSOC);
        foreach($dataRec as $key){
            $main->setContent("testo", $key['testo']);
        }
    } 
    //voglio visualizzare le recensioni sotto forma di griglia 
    //(titolo con stelle e sotto commento)

    $dettN->getDettagliN($prod->id);
    $main->setContent("energia", $dettN->getEnergia());
    $main->setContent("grassi", $dettN->getGrassi());
    $main->setContent("carboidrati", $dettN->getCarboidrati());
    $main->setContent("proteine", $dettN->getProteine());
    $main->setContent("sale", $dettN->getSale());
    $main->setContent("anidrite_carbonica", $dettN->getAnidriteCarbonica());
    $main->setContent("calcio", $dettN->getCalcio());
    $main->setContent("sodio", $dettN->getSodio());
    
    //voglio visualizzare i dettagli nutrizionali sotto forma di tabella
    //qua devi prendere il result set dalla querry e fare nometemplate->setContent("nometag", $var) per ogni 

    //seleziono l'id del produttore dalla tabella prodotto
    //e prendo il link del sito
    //implementare le funzioni dentro produttore e PDO per fare la query per ottenere queste

    $main->close();
    
?>