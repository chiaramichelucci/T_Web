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
    } elseif($_SESSION['user_group'] == 2) {
        $bar = new Template("../dtml/userBarGeneric.html");
        $main->setContent("userbar", $bar->get());
    } else {
        $bar = new Template("../dtml/userBarAdmin.html");
        $main->setContent("userbar", $bar->get());
    }

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        $opS->setIdUtente($_SESSION['user_id']);
    } else {
        $msg = "Devi essere logato per accedere a questo servizio";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    $database = new Database();
    $db = $database->getConnection();
    $opS = new OpzioneSpedizione($db);
    $opS->setId($_POST['id']);

    if(isset($_POST['citta'])) {
        $opS->setCitta($_POST['citta']);
    } elseif(empty($_POST['citta'])) {
        $opS->setCitta("");
    }

    if(isset($_POST['via'])) {
        $opS->setCitta($_POST['via']);
    } elseif(empty($_POST['via'])) {
        $opS->setCitta("");
    }

    if(isset($_POST['ncivico'])) {
        $opS->setCitta($_POST['ncivico']);
    } elseif(empty($_POST['ncivico'])) {
        $opS->setCitta("");
    }

    if(isset($_POST['cap'])) {
        $opS->setCitta($_POST['cap']);
    } elseif(empty($_POST['cap'])) {
        $opS->setCitta("");
    }

    if(isset($_POST['prov'])) {
        $opS->setCitta($_POST['prov']);
    } elseif(empty($_POST['prov'])) {
        $opS->setCitta("");
    }

    if(isset($_POST['paese'])) {
        $opS->setCitta($_POST['paese']);
    } elseif(empty($_POST['paese'])) {
        $opS->setCitta("");
    }

    if(isset($_POST['particolarita'])) {
        $opS->setCitta($_POST['particolarita']);
    } elseif(empty($_POST['particolarita'])) {
        $opS->setCitta("");
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

    if($status){
        header("Location: ../Controllers/userProfile.php");
    }else{
        $msg = "Modifica falita";
        $error->setContent("msgError", $msg);
        $error->close();
    }

?>