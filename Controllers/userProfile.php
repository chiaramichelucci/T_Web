<?php

    require "../Data/user.php";
    require "../Data/opzioneSpedizione.php";
    require "../Data/OpzionePagamento.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    $main = new Template("../dtml/userProfile.html");

    $checkSession = session_status();
    if($checkSession == PHP_SESSION_NONE || $checkSession == PHP_SESSION_DISABLED){
        $error = new Template("../dtml/userError.html");
        $msg = "Non hai accesso a questa pagina";
        
    } else {
        $userInfo = $_SESSION['user'];
    }

    $main->close();
?>