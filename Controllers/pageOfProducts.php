<?php

	require "../PDO/database.php";
	require "../Data/immagine.php";
	require "../Data/prodotto.php";
	require "../include/template2.inc.php";

	$main = new Template("../dtml/listaProdotti.html"); 	// template principale comune a tutte le pagine del sito
	//$body = new Template("dtml/homepage.html"); 		// sottotemplate per la home
	$card = new Template("../dtml/products.html"); // sottotemplate per il singolo prodotto

	/* banner section */

	$database = new Database();
    $db = $database->getConnection();
	$prodotti = new Prodotto($db);
	$stmt = $prodotti->getNomePrezzo();
	$num = $stmt->rowCount();
	$images = new Immagine($db);

	if($num>0){
	while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$id = print_r($data['prod_id'], true);
		//print(" id -> " . $id);
		$img = $images->getByProdId($id);
		$numImg = $img->rowCount();
		if($numImg>0){
			$dataImg = $img->fetch(PDO::FETCH_ASSOC);
			$card->setContent("url", $dataImg['url_prod_img']);
		} else {
			$card->setContent("url", "../dtml/images/imgmissing.png");
		}
		//print_r($img);
		foreach($data as $key => $value) {
			$card->setContent($key, $value);
		}
	};
	}

	$main->setContent("prodotti", $card->get());
	$main->close();

?>