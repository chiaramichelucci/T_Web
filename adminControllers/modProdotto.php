<?php

    require "../include/template2.inc.php";
    require "../Data/Prodotto.php";
    require "../Data/Categoria.php";
    require "../Data/Produttore.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/modProdotto.html");
            $nav = new Template("../dashboard/pages/navigation.html");
            $nav->setContent("user_email", $_SESSION['user_email']);
            $nav->setContent("user_email", $_SESSION['user_id']);
            $main->setContent("navigation", $nav->get());
		} elseif(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 2){
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }else{
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }
    }else{
        $error->setContent("msgErrore", "Non hai permesso qui");
        $error->close();
    }

    $database = new Database();
    $db = $database->getConnection();
    $prodotto = new Prodotto($db);
    $categoria = new Categoria($db);
    $produttore = new Produttore($db);
    $cat = $categoria->getAll();
    $prod = $produttore->getAll();
    //$rs_cat = $cat->fetchAll(PDO::FETCH_ASSOC);
    //$rs_prod = $prod->fetchAll(PDO::FETCH_ASSOC);


    if(isset($_GET['id']) && !empty($_GET['id'])){
        $prodotto->getProdotto($_GET['id']);
    }else{
        $error->setContent("msgErrore", "Devi selezionare un prodotto");
    }

    $main->setContent("id", $prodotto->id);
    $main->setContent("nome", $prodotto->nome);
    $main->setContent("prezzo", $prodotto->prezzo);
    $main->setContent("sconto", $prodotto->sconto);
    $main->setContent("categoria", $prodotto->id_categoria);
    $main->setContent("descrizione", $prodotto->descrizione);
    $main->setContent("id_produttore", $prodotto->id_produttore);

    while($data = $cat->fetch(PDO::FETCH_ASSOC)){
        if($data['id'] == $prodotto->id_categoria){
            $main->setContent("nome_categoria", $data['nome']);
        }
        $main->setContent("categoria_id", $data['id']);
        $main->setContent("categoria_nome", $data['nome']);
    }

    while($data = $prod->fetch(PDO::FETCH_ASSOC)){
        if($data['id'] == $prodotto->id_produttore){
            $main->setContent("rs_produttore", $data['ragione_sociale']);
        }
        $main->setContent("produttore_id", $data['id']);
        $main->setContent("produttore_rs", $data['ragione_sociale']);

    }

    $main->close();
    

?>
