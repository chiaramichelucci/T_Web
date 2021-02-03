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
    $opP = new OpzionePagamento($db);

    if(isset($_POST['ncarta']) && !empty($_POST['ncarta'])) {
        $opP->setCitta($_POST['ncarta']);
    } else {
        $msg = "Non hai inserito il numero carta";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['scadenza']) && !empty($_POST['scadenza'])) {
        $opP->setCitta($_POST['scadenza']);
    } else {
        $msg = "Non hai inserito la scadenza";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['cvv']) && !empty($_POST['cvv'])) {
        $opP->setCitta($_POST['cvv']);
    } else {
        $msg = "Non hai inserito il cvv ";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    if(isset($_POST['nprop']) && !empty($_POST['nprop'])) {
        $opP->setCitta($_POST['nprop']);
    } else {
        $msg = "Non hai inserito il nome proprietario";
        $error->setContent("msgError", $msg);
        $error->close();
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