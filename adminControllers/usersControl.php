<?php

    require "../include/template2.inc.php";
    require "../Data/User.php";
    require "../Data/Groups.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$main = new Template("../dashboard/pages/userControl.html");
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
