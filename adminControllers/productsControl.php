<?php

    require "../include/template2.inc.php";
    require "../Data/Prodotto.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/productsControl.html");
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
    $prodotti = new Prodotto($db);
    $rs = $prodotti->getProdotti();

    while($data = $rs->fetch(PDO::FETCH_ASSOC)){
        foreach($data as $key => $value){
            $main->setContent($key, $value);
        }
    }

    $main->close();

?>
