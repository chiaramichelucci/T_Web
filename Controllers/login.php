<?php
    require "../Data/user.php";
    require "../Data/Groups.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    $main = new Template("");  //il template da iniziare in caso di login con sucesso
    $error = new Template(""); // in caso di login falito

    $checkSession = session_status();
    if($checkSession == PHP_SESSION_NONE){
        $failed = false; // tiene conto dello stato del login
        $username = (isset( $_POST['username']) && !empty($_POST['username'])) ? $_POST['username'] : $failed = true;
        $password = (isset( $_POST['password']) && !empty($_POST['username'])) ? $_POST['password'] : $failed = true;
        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);
        $utente = $user->checkUser($username, $password);
        //$user->checkUser("dragos@magnacad.it", "dragos");
        if($user->id == 0){
            $failed = true;
            $error->setContent("messagio", "Username e password sbalgiate");
        } else {
            $group = new Groups($db);
            $userGroup = $group->checkGroup($user->id);
        }
        if(!$failed){
           start_session();
           $_SESSION['user'] = $user;
           $_SESSION['group'] = $userGroup;
        } else {
            $main->setContent("error", $error->get());
        }
    }

    $main->close();

?>