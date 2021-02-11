<?php

    require "../Data/user.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    session_start();
	$checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/index.html");
		} elseif(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 2){
            $error = new Template("../dtml/error.html");
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }else{
            $error = new Template("../dtml/error.html");
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }
    }else{
        $error = new Template("../dtml/error.html");
        $error->setContent("msgErrore", "Non hai permesso qui");
        $error->close();
    }

    $main->close();

?>