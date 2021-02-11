<?php

    require "../include/template2.inc.php";
    require "../Data/Prodotto.php";
    require "../Data/Produttore.php";
    require "../Data/Categoria.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/productsControl.html");
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
    $prodotti = new Prodotto($db);
    $produttore = new Produttore($db);
    $categoria = new Categoria($db);
    $rs = $prodotti->getProdotti();

    while($data = $rs->fetch(PDO::FETCH_ASSOC)){
        $prod = $produttore->getById($data['id_produttore']);
        $ragione_sociale = $prod->fetch(PDO::FETCH_ASSOC);
        $main->setContent("nome_produttore", $ragione_sociale['ragione_sociale']);
        $cat = $categoria->getById($data['categoria']);
        $nomeCat = $cat->fetch(PDO::FETCH_ASSOC);
        $main->setContent("nome_categoria", $nomeCat['nome']);
        foreach($data as $key => $value){
            $main->setContent($key, $value);
        }
    }

    $main->close();

?>
