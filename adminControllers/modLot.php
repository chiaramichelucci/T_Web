<?php

    require "../include/template2.inc.php";
    require "../Data/Prodotto.php";
    require "../Data/Lotto.php";
    require "../Data/Stabilimento.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/modLot.html");
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
    $lotto = new Lotto($db);
    $stabilimento = new Stabilimento($db);
    $prodotto = new Prodotto($db);
    $stab = $stabilimento->getAll();
    $prod = $prodotto->getAll();
    //$rs_cat = $cat->fetchAll(PDO::FETCH_ASSOC);
    //$rs_prod = $prod->fetchAll(PDO::FETCH_ASSOC);


    if(isset($_GET['id']) && !empty($_GET['id'])){
        $lotto->getLotto($_GET['id']);
    }else{
        $error->setContent("msgErrore", "Devi selezionare un prodotto");
    }

    $main->setContent("id", $lotto->id);
    $main->setContent("numero", $lotto->numero);
    $main->setContent("quantita_disponibile", $lotto->quantita_disponibile);
    $main->setContent("scadenza", $lotto->scadenza);
    $main->setContent("id_prodotto", $lotto->id_prodotto);
    $main->setContent("id_stabilimento", $lotto->id_stabilimento);

    while($data = $prod->fetch(PDO::FETCH_ASSOC)){
        if($data['id'] == $lotto->id_prodotto){
            $main->setContent("nome_prodotto", $data['nome']);
        }
        $main->setContent("prodotto_id", $data['id']);
        $main->setContent("prodotto_nome", $data['nome']);
    }

    while($data = $stab->fetch(PDO::FETCH_ASSOC)){
        if($data['id'] == $lotto->id_stabilimento){
            $main->setContent("nome_stabilimento", $data['nome']);
        }
        $main->setContent("stabilimento_id", $data['id']);
        $main->setContent("stabilimento_nome", $data['nome']);
    }

    $main->close();
    

?>
