<?php

require "../Data/user.php";
require "../PDO/database.php";
require "../include/template2.inc.php";

    session_start();

    //$main = new Template("../dtml/changeEmail.html");
    $error = new Template("../dtml/error.html");

    /*$checkSession = session_status();
    if($checkSession == PHP_SESSION_NONE || $checkSession == PHP_SESSION_DISABLED){
        $msg = "Non hai accesso a questa pagina";
        $error->setContent("msgError", $msg);
        $error->close();
    } elseif($_SESSION['user_group'] == 2) {
        $bar = new Template("../dtml/userBarGeneric.html");
        $main->setContent("userbar", $bar->get());
    } else {
        $bar = new Template("../dtml/userBarAdmin.html");
        $main->setContent("userbar", $bar->get());
    }*/

    $newEmail = (isset( $_POST['newEmail']) && !empty($_POST['newEmail'])) ? $_POST['newEmail'] : $failed = true;
    //$oldEmail = (isset( $_POST['oldEmail']) && !empty($_POST['oldEmail'])) ? $_POST['oldEmail'] : $failed = true;

    if($newEmail != $_SESSION['user_email']){
        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);
        $user->changeEmail($_SESSION['user_id'], $newEmail);
        $_SESSION['user_email'] = $newEmail;
    }else{
        $msg="La nuova email non puo essere la stessa.";
        $error->setContent("msgError", $msg);
        $error->close();
    }

    header('Location: ../Controllers/userProfile.php');
    

?>