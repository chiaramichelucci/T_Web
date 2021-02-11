<?php

    require "../Data/opzionePagamento.php";
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
    $opP = new OpzionePagamento($db);
    $opP->setID($_POST['id']);

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        $opP->setIdUser($_SESSION['user_id']);
    } else {
        $msg = "Devi essere logato per accedere a questo servizio";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['numero'])) {
        $opP->setNumeroCarta($_POST['numero']);
    } elseif(empty($_POST['cinumerotta'])) {
        $opP->setNumeroCarta("");
    }

    if(isset($_POST['cvv'])) {
        $opP->setCvv($_POST['cvv']);
    } elseif(empty($_POST['cvv'])) {
        $opP->setCvv("");
    }

    if(isset($_POST['scadenza'])) {
        $opP->setScadenza($_POST['scadenza']);
    } elseif(empty($_POST['scadenza'])) {
        $opP->setScadenza("");
    }

    if(isset($_POST['nome'])) {
        $opP->setNomeProprietario($_POST['nome']);
    } elseif(empty($_POST['nome'])) {
        $opP->setNomeProprietario("");
    }


    if($opP->getNumeroCarta() == "" &&
       $opP->getCvv() == "" &&
       $opP->getScadenza() == "" &&
       $opP->getNomeProprietario() == "")
    {
        $status = $opP->cancellaOpzionePagamento($opP->getID());
    } else {
        $status = $opP->modificaOpzionePagamento($opP->getID());
    }

    if($status){
        header("Location: ../Controllers/userProfile.php");
    }else{
        $msg = "Modifica fallita";
        $error->setContent("msgError", $msg);
        $error->close();
    }

?>