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
			$main = new Template("../dashboard/pages/newProduct.html");
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
    $categoria = new Categoria($db);
    $produttore = new produttore($db);
    $rs_categoria = $categoria->getAll();
    $rs_produttore = $produttore->getAll();
    $cat = $rs_categoria->fetchAll(PDO::FETCH_ASSOC);
    $prod = $rs_produttore->fetchAll(PDO::FETCH_ASSOC);
    foreach($cat as $key){
        $main->setContent("categoria_id", $key['id']);
        $main->setContent("categoria_nome", $key['nome']);
    }
    foreach($prod as $key){
        $main->setContent("produttore_id", $key['id']);
        $main->setContent("produttore_rs", $key['ragione_sociale']);
    }


    $main->close();

?>
