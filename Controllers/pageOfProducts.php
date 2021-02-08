<?php

	require "../PDO/database.php";
	require "../Data/immagine.php";
	require "../Data/prodotto.php";
	require "../include/template2.inc.php";

	session_start();
	$checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if($_SESSION['group'] == 1){
			$bar = new Template("../dtml/userBarAdmin.html");
		} else {
			$bar = new Template("../dtml/userBarGeneric.html");
		}
	} else {
		$bar = new Template("../dtml/userBarUnsigned.html");
	}

	$main = new Template("../dtml/listaProdotti.html"); 	// template principale comune a tutte le pagine del sito
	$card = new Template("../dtml/products.html"); // sottotemplate per il singolo prodotto
	$pag = new Template("../dtml/pagination.html");

	/* banner section */ //da vedere limit e la paginazione

	$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 9;
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;

	$database = new Database();
    $db = $database->getConnection();
	$prodotti = new Prodotto($db);
	$s = $prodotti->getAll();
	$total_results = $s->fetchColumn();
	$total_pages = ceil($total_results/$limit);
	$starting_limit = ($page-1)*$limit;   
	print("start->" . $starting_limit);         
	$stmt = $prodotti->getNProd($starting_limit, $limit);
	$num = $stmt->rowCount();
	$images = new Immagine($db);

	if($num>0){
	while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
	};
	}
	/*if($page==1){
		$succ = $page+1;
		$pag->setContent("page_nC", $page);
		$pag->setContent("page_nN", $succ);
		$pag->setContent("page_linkC", "#");
		$pag->setContent("page_linkN", "?page=" . $succ);
	}elseif($page<$total_pages){
		$prev = $page-1;
		$succ = $page+1;
		$pag->setContent("page_nP", $prev);
		$pag->setContent("page_nC", $page);
		$pag->setContent("page_nN", $succ);
		$pag->setContent("page_linkP", "?page=" . $prev);
		$pag->setContent("page_linkC", "#");
		$pag->setContent("page_linkN", "?page=" . $succ);
	}else{
		$prev = $page-1;
		$pag->setContent("page_nP", $prev);
		$pag->setContent("page_nC", $page);
		$pag->setContent("page_linkP", "?page=" . $prev);
		$pag->setContent("page_linkC", "#");
	}*/
	$prev = $page-1;
	$succ = $page+1;
	$pag->setContent("page_linkP",  $prev);
	$pag->setContent("page_nC", $page);
	$pag->setContent("page_linkN", $succ);

	
	$main->setContent("userbar", $bar->get());
	$main->setContent("prodotti", $card->get());
	$main->setContent("paging", $pag->get());
	$main->close();

?>