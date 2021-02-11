<?php

    require "../include/template2.inc.php";
    require "../Data/Produttore.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			
            $database = new Database();
            $db = $database->getConnection();
            $prod = new Produttore($db);
            $prod->id = $_POST['id_prod'];
            $prod->ragione_sociale = $_POST['rs_prod'];
            $prod->partita_iva = $_POST['piva_prod'];
            $prod->prefisso = $_POST['pref_prod'];
            $prod->numero_verde = $_POST['nr_prod'];
            $prod->email = $_POST['email_prod'];
            $prod->sito = $_POST['sito_prod'];

            $status = $prod->modificaProduttore();
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
