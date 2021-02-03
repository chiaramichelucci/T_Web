<?php

require "../include/template2.inc.php";

    session_start();

    $main = new Template("../dtml/changeEmail.html");
    $error = new Template("../dtml/error.html");

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

    $main->setContent("user_email", $_SESSION['user_email']);
    $main->close();

?>