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
    $opS->setId($POST['id']);

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        $opS->setIdUtente($_SESSION['user_id']);
    } else {
        $msg = "Devi essere logato per accedere a questo servizio";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['citta'])) {
        $opS->setCitta($_POST['citta']);
    } elseif(empty($_POST['citta'])) {
        $opS->setCitta("");
    }

    if(isset($_POST['via'])) {
        $opS->setVia($_POST['via']);
    } elseif(empty($_POST['via'])) {
        $opS->setVia("");
    }

    if(isset($_POST['ncivico'])) {
        $opS->setNumero($_POST['ncivico']);
    } elseif(empty($_POST['ncivico'])) {
        $opS->setNumero("");
    }

    if(isset($_POST['cap'])) {
        $opS->setCap($_POST['cap']);
    } elseif(empty($_POST['cap'])) {
        $opS->setCap("");
    }

    if(isset($_POST['prov'])) {
        $opS->setProvincia($_POST['prov']);
    } elseif(empty($_POST['prov'])) {
        $opS->setProvincia("");
    }

    if(isset($_POST['paese'])) {
        $opS->setPaese($_POST['paese']);
    } elseif(empty($_POST['paese'])) {
        $opS->setPaese("");
    }

    if(isset($_POST['particolarita'])) {
        $opS->setAltreParticolarita($_POST['particolarita']);
    } elseif(empty($_POST['particolarita'])) {
        $opS->setAltreParticolarita("");
    }

    if($opS->getCitta() == "" &&
       $opS->getVia() == "" &&
       $opS->getNumero() == "" &&
       $opS->getCap() == "" &&
       $opS->getProvincia() == "" &&
       $opS->getPaese() == "" &&
       $opS->getAltreParticolarita() == "")
    {
        $status = $opS->cancellaOpzioneSpedizione($opS->getID());
    } else {
        $status = $opS->modificaOpzioneSpedizione($opS->getID());
    }

    /*if($status){
        header("Location: ../Controllers/userProfile.php");
    }else{
        $msg = "Modifica falita";
        $error->setContent("msgError", $msg);
        $error->close();
    }*/

?>