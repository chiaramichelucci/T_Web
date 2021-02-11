<?php

    require "../include/template2.inc.php";
    require "../Data/User.php";
    require "../Data/Groups.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/userControl.html");
            $nav = new Template("../dashboard/pages/navigation.html");
            $nav->setContent("user_email", $_SESSION['user_email']);
            $nav->setContent("user_email", $_SESSION['user_id']);
            $main->setContent("navigation", $nav->get());
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

    $database = new Database();
    $db = $database->getConnection();
    $users = new User($db);
    $rs = $users->getUsers();

    while($data = $rs->fetch(PDO::FETCH_ASSOC)){
        $grupo = new Groups($db);
        $group = $grupo->checkGroup($data['id']); 
        //$main->setContent("id_gruppo", $group);
        foreach($data as $key => $value){
            $main->setContent($key, $value);
        }
        $main->setContent("id_gruppo", $group['groups_id']);
    }

    $main->close();

?>
