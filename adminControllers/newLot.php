<?php

    require "../include/template2.inc.php";
    require "../Data/Prodotto.php";
    require "../Data/Stabilimento.php";
    require "../Data/Lotto.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/newLot.html");
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
    $lot = new Lotto($db);
    $prodotti = new Prodotto($db);
    $stabilimento = new Stabilimento($db);
    $rs_prodotti = $prodotti->getAll();
    $rs_stabilimento = $stabilimento->getAll();
    $prod = $rs_prodotti->fetchAll(PDO::FETCH_ASSOC);
    $stab = $rs_stabilimento->fetchAll(PDO::FETCH_ASSOC);
    foreach($stab as $key){
        $main->setContent("stabilimento_id", $key['id']);
        $main->setContent("stabilimento_nome", $key['nome']);
    }
    foreach($prod as $key){
        $main->setContent("prodotto_id", $key['id']);
        $main->setContent("prodotto_nome", $key['nome']);
    }

    $main->close();

?>
