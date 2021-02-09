<?php

require "../Data/user.php";
require "../PDO/database.php";
require "../include/template2.inc.php";

    session_start();

    //$main = new Template("../dtml/changeEmail.html");
    $error = new Template("../dtml/error.html");

    session_start();
	$checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['group']) && !empty($_SESSION['group']) && $_SESSION['group'] == 1){
			$bar = new Template("../dtml/userBarAdmin.html");
		} elseif(isset($_SESSION['group']) && !empty($_SESSION['group']) && $_SESSION['group'] == 2){
            $bar = new Template("../dtml/userBarGeneric.html");
        }else{
            $bar = new Template("../dtml/userBarUnsigned.html");
        }
    }else{
        $bar = new Template("../dtml/userBarUnsigned.html");
    }

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