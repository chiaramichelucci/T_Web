<?php
    require "../Data/user.php";
    require "../Data/groups.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    $main = new Template("../dtml/mainFrame.html");  //il template da iniziare in caso di login con successo
    $error = new Template("../dtml/error.html"); // in caso di login fallito

    //chiedere al prof la buona norma per fare login automatico dopo la registrazione

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
            $error->setContent("messaggio", "Username e password errate!");
        } else {
            $group = new Groups($db);
            $userGroup = $group->checkGroup($user->id);
        }
        if(!$failed){
            $checkSession = session_status();
            if($checkSession == PHP_SESSION_ACTIVE){
            session_destroy();
            }
           start_session();
           $_SESSION['user'] = $user;
           $_SESSION['group'] = $userGroup;
        } else {
            $main->setContent("error", $error->get());
        }

    $main->close();

?>