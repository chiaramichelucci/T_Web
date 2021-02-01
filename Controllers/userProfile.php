<?php

    require "../Data/user.php";
    require "../Data/opzioneSpedizione.php";
    require "../Data/OpzionePagamento.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    $main = new Template("../dtml/userProfile.html");
    session_start();
    $checkSession = session_status();
    if($checkSession == PHP_SESSION_NONE || $checkSession == PHP_SESSION_DISABLED){
        $error = new Template("../dtml/userError.html");
        $msg = "Non hai accesso a questa pagina";
        $error->setContent("msgError", $msg);
        $error->close();
    } else {
        $bar = new Template("../dtml/userBarGeneric.html");
        $main->setContent("userbar", $bar->get());
    }

    $main->setContent("user_nome", $_SESSION['user_nome']);
    $main->setContent("user_cognome", $_SESSION['user_cognome']);
    $main->setContent("user_email", $_SESSION['user_email']);

    $database = new Database();
    $db = $database->getConnection();
    $opS = new OpzioneSpedizione($db);
    $opP = new OpzionePagamento($db);
    $opSpedizione = $opS->getOSUser($_SESSION['user_id']);

    while ($data = $opSpedizione->fetch(PDO::FETCH_ASSOC)){
        foreach($data as $key => $value){
            $main->setContent($key, $value);
        }
    }

    $opPagamento = $opP->getOPUser($_SESSION['user_id']);

    while ($data = $opPagamento->fetch(PDO::FETCH_ASSOC)){
        foreach($data as $key => $value){
            $main->setContent($key, $value);
        }
    }

    $opS = new OpzioneSpedizione($db);

    $main->close();
?>