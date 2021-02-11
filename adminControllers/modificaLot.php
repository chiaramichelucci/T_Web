<?php

    require "../include/template2.inc.php";
    require "../Data/Lotto.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			
            $database = new Database();
            $db = $database->getConnection();
            $lotto = new Lotto($db);
            $lotto->id = $_POST['id_lot'];
            $lotto->numero = $_POST['nr_lot'];
            $lotto->quantita_disponibile = $_POST['q_lot'];
            $lotto->scadenza = $_POST['sca_lot'];
            $lotto->id_prodotto= $_POST['prod_lot'];
            $lotto->id_stabilimento = $_POST['sta_lot'];

            $status = $lotto->modificaLotto();
            if(!$status){
                $error->setContent("msgErrore", "Modifica Falita");
            }
            header("Location: adminDashboard.php");
            
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


?>
