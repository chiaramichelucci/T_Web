<?php

    require "../include/template2.inc.php";
    require "../Data/Produttore.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/modProduttore.html");
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
    $produttore = new Produttore($db);

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $produttore->getProduttore($_GET['id']);
    }else{
        $error->setContent("msgErrore", "Devi selezionare un prodotto");
    }

    $main->setContent("id", $produttore->id);
    $main->setContent("rs", $produttore->ragione_sociale);
    $main->setContent("piva", $produttore->partita_iva);
    $main->setContent("pref", $produttore->prefisso);
    $main->setContent("nr", $produttore->numero_verde);
    $main->setContent("email", $produttore->email);
    $main->setContent("sito", $produttore->sito);

    $main->close();
    

?>
