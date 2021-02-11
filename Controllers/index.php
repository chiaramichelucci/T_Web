<?php

    require "../include/template2.inc.php";

    session_start();
	$checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$bar = new Template("../dtml/userBarAdmin.html");
		} elseif(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 2){
            $bar = new Template("../dtml/userBarGeneric.html");
        }else{
            $bar = new Template("../dtml/userBarUnsigned.html");
        }
    }else{
        $bar = new Template("../dtml/userBarUnsigned.html");
    }
    $main = new Template("../dtml/index.html"); 	// template principale comune a tutte le pagine del sito

    $main->setContent("userbar", $bar->get());
    $main->close();

?>