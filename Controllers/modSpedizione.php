<?php

    require "../Data/opzioneSpedizione.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    $main = new Template("../dtml/modOpzioneSpedizione.html");
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

    $database = new Database();
    $db = $database->getConnection();
    $opS = new OpzioneSpedizione($db);

    if(isset($_POST['opzioneSpedizione']) && !empty($_POST['opzioneSpedizione'])){
        $opS->getOpzione($_POST['opzioneSpedizione']);

        $main->setContent("op_id", $opS->getID());
        $main->setContent("op_citta", $opS->getCitta());
        $main->setContent("op_via", $opS->getVia());
        $main->setContent("op_ncivico", $opS->getNumero());
        $main->setContent("op_cap", $opS->getCap());
        $main->setContent("op_prov", $opS->getProvincia());
        $main->setContent("op_paese", $opS->getPaese());
        $main->setContent("op_particolarita", $opS->getAltreParticolarita());
        $main->close();
    } else {
        $error->setContent("msgErrore", "Devi selezionare una delle opzioni di spedizione");
        $error->close();
    }

?>