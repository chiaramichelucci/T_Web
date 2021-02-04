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
    $opP->setID($_GET['id']);

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        $opP->setIdUser($_SESSION['user_id']);
    } else {
        $msg = "Devi essere logato per accedere a questo servizio";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    $status = $opP->cancellaOpzionePagamento($opP->getID());

    if($status){
        header("Location: ../Controllers/userProfile.php");
    }else{
        $msg = "Modifica falita";
        $error->setContent("msgError", $msg);
        $error->close();
    }

?>