<?php

    session_start();
    $checkSession = session_status();
    if($checkSession == PHP_SESSION_ACTIVE){
        session_destroy();
    }
    header('Location: ../index.php')

?>