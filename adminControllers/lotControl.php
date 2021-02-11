<?php

    require "../include/template2.inc.php";
    require "../Data/Lotto.php";
    require "../Data/Prodotto.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/lotControl.html");
            $nav = new Template("../dashboard/pages/navigation.html");
            $nav->setContent("user_email", $_SESSION['user_email']);
            $nav->setContent("user_email", $_SESSION['user_id']);
            $main->setContent("navigation", $nav->get());
		} elseif(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 2){
            $error = new Template("../dtml/error.html");
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }else{
            $error = new Template("../dtml/error.html");
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }
    }else{
        $error = new Template("../dtml/error.html");
        $error->setContent("msgErrore", "Non hai permesso qui");
        $error->close();
    }

    $database = new Database();
    $db = $database->getConnection();
    $lotto = new Lotto($db);
    $prodotto = new Prodotto($db);
    $rs = $lotto->getAll();

    while($data = $rs->fetch(PDO::FETCH_ASSOC)){
        $prod = $prodotto->getNomeById($data['id_prodotto']);
        $nome = $prod->fetch(PDO::FETCH_ASSOC);
        $main->setContent("prodotto_nome", $nome['nome']);
        foreach($data as $key => $value){
            $main->setContent($key, $value);
        }
    }

    $main->close();

?>
