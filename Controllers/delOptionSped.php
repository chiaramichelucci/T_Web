<?php

    require "../Data/opzioneSpedizione.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    $error = new Template("../dtml/error.html");
    session_start();
    $checkSession = session_status();
    if($checkSession == PHP_SESSION_NONE || $checkSession == PHP_SESSION_DISABLED){
        $msg = "Non hai accesso a questa pagina";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    $database = new Database();
    $db = $database->getConnection();
    $opS = new OpzioneSpedizione($db);
    $opS->setId($_GET['id']);

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        $opS->setIdUtente($_SESSION['user_id']);
    } else {
        $msg = "Devi essere logato per accedere a questo servizio";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    $status = $opS->cancellaOpzioneSpedizione($opS->getID());

    if($status){
        header("Location: ../Controllers/userProfile.php");
    }else{
        $msg = "Modifica fallita";
        $error->setContent("msgError", $msg);
        $error->close();
    }

?>