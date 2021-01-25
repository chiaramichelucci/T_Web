<?php

	require "../PDO/database.php";
	require "../Data/immagine.php";
	require "../Data/prodotto.php";
	require "../include/template2.inc.php";

	$main = new Template("../dtml/listaProdotti.html"); 	// template principale comune a tutte le pagine del sito
	//$body = new Template("dtml/homepage.html"); 		// sottotemplate per la home
	$card = new Template("../dtml/products.html"); // sottotemplate per il singolo prodotto
	$pag = new Template("../dtml/pagination.html");

	/* banner section */

	$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 9;
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;

	$database = new Database();
    $db = $database->getConnection();
	$prodotti = new Prodotto($db);
	$s = $prodotti->getAll();
	$total_results = $s->fetchColumn();
	$total_pages = ceil($total_results/$limit);
	$starting_limit = ($page-1)*$limit;            //sto limit non mi convince
	$stmt = $prodotti->getNProd($starting_limit, $limit);
	$num = $stmt->rowCount();
	$images = new Immagine($db);

	/*$pag->setContent("page_nP", $page-1);
	$pag->setContent("page_nC", $page);
	$pag->setContent("page_nN", $page+1);
	$pag->setContent("page_linkP", "?page=" . $page-1);
	$pag->setContent("page_linkC", "#");
	$pag->setContent("page_linkN", "?page=" . $page+1);
	if($page=1){
		$pag->setContent("page_classP", "disabled");
		$pag->setContent("page_classC", "current");
		$pag->setContent("page_classP", "");
	}*/

	/*foreach($total_pages as $pagina){
		if($page == $pagina){
			$pag->setContent("pageClass");
		}
	}*/

	/*$html = '<ul class="pagination">';
	if($page == 1){
		$class = "disabled";
	} else {
		$class = "";
	}
	$html = '<li class="' . $class . '"><a href="?page="' . $page . '';*/

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

	$main->setContent("prodotti", $card->get());
	$main->setContent("paging", $pag->get());
	$main->close();

?>