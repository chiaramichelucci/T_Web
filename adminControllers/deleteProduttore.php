<?php

    require "../include/template2.inc.php";
    require "../Data/Produttore.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = $_GET['id'];
            }
            $database = new Database();
            $db = $database->getConnection();
            $prod = new Produttore($db);
            $status = $prod->eliminaProduttore($id);
            if(!$status){
                $error->setContent("msgErrore", "Eliminazione Falita");
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
