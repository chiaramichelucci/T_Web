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
			$main = new Template("../dashboard/pages/modUser.html");
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
    $user = new User($db);
    $group = new Groups($db);

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $user->getUser($_GET['id']);
    }else{
        $error->setContent("msgErrore", "Devi selezionare un prodotto");
    }

    $main->setContent("id", $user->id);
    $main->setContent("email", $user->email);

    $groups = $group->getGroups();
    $userGroup = $group->checkGroup($user->id);
    while($data = $groups->fetch(PDO::FETCH_ASSOC)){
        //$main->setContent("id_group")$group->checkGroup($user->id)
        $main->setContent("group_id", $data['id']);
        $main->setContent("group_nome", $data['denominazione']);
        if($userGroup['groups_id'] == $data['id']){
            $main->setContent("name_group", $data['denominazione']);
            $main->setContent("id_group", $userGroup['groups_id']);
        }
    }

    $main->close();
    

?>
