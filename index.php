<?php

    require "include/template2.inc.php";

    $checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if($_SESSION['group'] == 1){
			$bar = new Template("dtml/userBarAdmin.html");
		} else {
			$bar = new Template("dtml/userBarGeneric.html");
		}
	} else {
		$bar = new Template("dtml/userBarUnsigned.html");
    }
    $main = new Template("dtml/index.html"); 	// template principale comune a tutte le pagine del sito

    $main->setContent("userbar", $bar->get());
    $main->close();

?>