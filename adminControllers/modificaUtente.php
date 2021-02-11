<?php

    require "../include/template2.inc.php";
    require "../Data/Groups.php";
    require "../Data/User.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			
            $database = new Database();
            $db = $database->getConnection();
            $user = new User($db);
            $group = new Groups($db);
            $status = $group->promoteUser($_POST['id_user'], $_POST['new_group']);
            
            if(!$status){
                $error->setContent("msgErrore", "Modifica Falita");
            }
            header("Location: adminDashboard.php");
            
		} elseif(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 2){
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }else{
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }
    }else{
        $error->setContent("msgErrore", "Non hai permesso qui");
        $error->close();
    }


?>
