<?php

    $checkSession = session_status();
    if($checkSession == PHP_SESSION_ACTIVE){
        session_destroy();
    }
    header();

?>