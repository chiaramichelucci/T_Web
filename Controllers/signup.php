<?php
require "../PDO/database.php";
require "../Data/User.php";


if (isset($_POST['submit'])) {     //controllo valori nella richiesta  

    $name = (isset( $_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : $msg = "niente name";
    $cogname = (isset( $_POST['cogname']) && !empty($_POST['cogname'])) ? $_POST['cogname'] : $msg = "niente cogname";
    $password = (isset( $_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : $msg = "niente password";
    $email = (isset( $_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : $msg = "niente email";
    $data_nascita = (isset( $_POST['dataNascita']) && !empty($_POST['dataNascita'])) ? $_POST['dataNascita'] : $msg = "niente data nascita";
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
    } elseif (false === $isEmailValid) { //controllo validità email
        $msg = 'Email non valida.';
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT); //cifratura password
        $database = new Database();
        $pdo = $database->getConnection(); //connessione al database
        $regUser = new User($pdo);
        $checkEmail = $regUser->checkEmail($email);
        
        
        if ($checkEmail) {            //controllo se lo email è già utilizzato
            $msg = 'Email già in uso %s';
        } else {
            $checkReg = $regUser->registerUser($name, $cogname, $password_hash, $email, $data_nascita);
            $msg = "Registrazione andata a buon fine";
            //if ($checkReg->rowCount() > 0) {
            //    $msg = 'Registrazione eseguita con successo';
            //} 
        }
    }
} else {
                $msg = 'Problemi con l\'inserimento dei dati %s';
           }  
    printf($msg, '');

?>