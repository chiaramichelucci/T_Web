<?php
require "../PDO/database.php";
require "../Data/user.php";
require "../include/template2.inc.php";

$failed = false;

while(!$failed){
    if(isset( $_POST['Nome']) && !empty($_POST['Nome'])){
        $name = $_POST['Nome'];
    }else{
        $msg = "niente name";
        $failed = true;
    }
    if(isset( $_POST['Cognome']) && !empty($_POST['Cognome'])){
        $cognome = $_POST['Cognome'];
    }else{
        $msg = "niente cognome";
        $failed = true;
    }
    if(isset( $_POST['password']) && !empty($_POST['password'])){
       $password = $_POST['password'];
    }else{
        $msg = "niente password";
        $failed = true;
    }
    if(isset( $_POST['Email']) && !empty($_POST['Email'])){
       $email = $_POST['Email'];
    }else{
        $msg = "niente email";
        $failed = true;
    }
    if(isset( $_POST['dataNascita']) && !empty($_POST['dataNascita'])){
        $data_nascita = $_POST['dataNascita'];
    }else{
        $msg = "niente data";
        $failed = true;
    }
    /*$isUsernameValid = filter_var(  //validazione username          
        $username,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );*/
    $isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL);  //validazione email
    $pwdLenght = mb_strlen($password);
    
    if ($pwdLenght < 8 || $pwdLenght > 20) { //controllo validità password
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
        $failed = true;
        callErrorTemplate($msg);
    } elseif (false === $isEmailValid) { //controllo validità email
        $msg = 'Email non valida.';
        $failed = true;
        callErrorTemplate($msg);
    } else {
        //$password_hash = password_hash($password, PASSWORD_BCRYPT); //cifratura password
        $password_hash = hash('sha256', $password);
        $database = new Database();
        $pdo = $database->getConnection(); //connessione al database
        $regUser = new User($pdo);
        $checkEmail = $regUser->checkEmail($email);
        
        
        if ($checkEmail) {            //controllo se lo email è già utilizzato
            $msg = 'Email già in uso %s';
            $failed = true;
            callErrorTemplate($msg);
        } else {
            $checkReg = $regUser->registerUser($name, $cognome, $password_hash, $email, $data_nascita);
            $msg = "Registrazione andata a buon fine";
            //if ($checkReg->rowCount() > 0) {
            //    $msg = 'Registrazione eseguita con successo';
            //} 
        }
    }
}
if($failed == true){
    callErrorTemplate($msg);
}

        
    function callErrorTemplate($errore){
        $error = new Template("../dtml/error.html");
        $error->setContent("msgError", $errore);
        $error->close();
    }
?>