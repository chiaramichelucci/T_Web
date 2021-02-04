<?php

    require "../Data/OpzionePagamento.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    $main = new Template("../dtml/modOpzionePagamento.html");
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
    $opP = new OpzionePagamento($db);

    if(isset($_POST['opzionePagamento']) && !empty($_POST['opzionePagamento'])){
        $opP->getOpzione($_POST['opzionePagamento']);

        $main->setContent("op_id", $opP->getID());
        $main->setContent("op_numero", $opP->getNumeroCarta());
        $main->setContent("op_cvv", $opP->getCvv());
        $main->setContent("op_scadenza", $opP->getScadenza());
        $main->setContent("op_nome", $opP->getNomeProprietario());
        $main->close();
    } else {
        $error->setContent("msgErrore", "Devi selezionare una delle opzioni di pagamento");
        $error->close();
    }

?>