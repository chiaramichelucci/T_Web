<?php

    require "../Data/user.php";
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

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        $opS->setIdUtente($_SESSION['user_id']);
    } else {
        $msg = "Devi essere logato per accedere a questo servizio";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['citta']) && !empty($_POST['citta'])) {
        $opS->setCitta($_POST['citta']);
    } else {
        $msg = "Non hai inserito la citta";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['via']) && !empty($_POST['via'])) {
        $opS->setVia($_POST['via']);
    } else {
        $msg = "Non hai inserito la via";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['ncivico']) && !empty($_POST['ncivico'])) {
        $opS->setNumero($_POST['ncivico']);
    } else {
        $msg = "Non hai inserito il numero civico";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['cap']) && !empty($_POST['cap'])) {
        $opS->setCap($_POST['cap']);
    } else {
        $msg = "Non hai inserito il cap";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['prov']) && !empty($_POST['prov'])) {
        $opS->setProvincia($_POST['prov']);
    } else {
        $msg = "Non hai inserito la provincia";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['paese']) && !empty($_POST['paese'])) {
        $opS->setPaese($_POST['paese']);
    } else {
        $msg = "Non hai inserito il paese";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['particolarita']) && !empty($_POST['particolarita'])) {
        $opS->setAltreParticolarita($_POST['particolarita']);
    } else {
        $opS->setAltreParticolarita("");
    }

    $status = $opS->aggiungiOpzioneSpedizione();
    if($status){
        header("Location: ../Controllers/userProfile.php");
    }else{
        $msg = "Inserimento falito";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    
?>