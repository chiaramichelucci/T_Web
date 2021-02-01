<?php
    require "../Data/user.php";
    require "../Data/groups.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    //$main = new Template("../dtml/mainFrame.html");  //il template da iniziare in caso di login con successo
    $error = new Template("../dtml/error.html"); // in caso di login fallito

    //chiedere al prof la buona norma per fare login automatico dopo la registrazione

    $failed = false; // tiene conto dello stato del login
        $email = (isset( $_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : $failed = true;
        $password = (isset( $_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : $failed = true;
        print(" Email -> " . $_POST['email']);
        print(" Password -> " . $_POST['password']);
        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);
        $user->checkUser($email, $password);
        //print($utente);
        //$user->checkUser("dragos@magnacad.it", "dragos");
        print(" User id -> " . $user->id);
        if($user->id == 0){
            $failed = true;
            $error->setContent("msgErrore", "Username e password errate!");
        } else {
            $group = new Groups($db);
            $userGroup = $group->checkGroup($user->id);
        }
        print($failed);
        if(!$failed){
            print(" Dentro if failed ");
            $checkSession = session_status();
            if($checkSession == PHP_SESSION_ACTIVE){
            session_destroy();
            }
           session_start();
           $_SESSION['user_id'] = $user->id;
           $_SESSION['user_nome'] = $user->nome;
           $_SESSION['user_cognome'] = $user->cognome;
           $_SESSION['user_email'] = $user->email;
           $_SESSION['user_dataNascita'] = $user->data_nascita;
           $_SESSION['user_group'] = $userGroup['groups_id'];
           header('Location: ../Controllers/userProfile.php');
        } else {
            $error->setContent("msgErrore", "login falito");
        }
    $error->close(); 

?>