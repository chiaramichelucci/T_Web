<?php
require_once('database.php');


if (isset($_POST['submit'])) {     //controllo valori nella richiesta             
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $isUsernameValid = filter_var(  //validazione username          
        $username,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );
    $isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL);  //validazione email
    $pwdLenght = mb_strlen($password);
    
    if (empty($username) || empty($password) || empty($email)) {  //controllo se un campo è vuoto
        $msg = 'Compila tutti i campi %s';
    } elseif (false === $isUsernameValid) { //controllo validità username
        $msg = 'Lo username non è valido. Sono ammessi solamente caratteri 
                alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
                Lunghezza massima 20 caratteri';
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) { //controllo validità password
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    } elseif (false === $isEmailValid) { //controllo validità email
        $msg = 'Email non valida.';
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT); //cifratura password
        $database = new Database();
        $pdo = $database->getConnection(); //connessione al database

        $query = "
            SELECT id
            FROM users
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $username, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($user) > 0) {            //controllo se lo username è già utilizzato
            $msg = 'Username già in uso %s';
        } else {
            $query = "
            SELECT id
            FROM users
            WHERE email = :email
            ";
        
            $check = $pdo->prepare($query);
            $check->bindParam(':email', $email, PDO::PARAM_STR);
            $check->execute();
            
            if ($check->rowCount() > 0) {       //controllo se l'email è già utilizzata
                $msg = 'Email già in uso <br/> %s';
            } else {
                $query = "
                INSERT INTO users
                VALUES (0, :username, :password, :email)
            ";
        
            $check = $pdo->prepare($query);
            $check->bindParam(':username', $username, PDO::PARAM_STR);
            $check->bindParam(':password', $password_hash, PDO::PARAM_STR);
            $check->bindParam(':email', $email, PDO::PARAM_STR);
            $check->execute();   //creazione utente
            
            if ($check->rowCount() > 0) {
                $msg = 'Registrazione eseguita con successo';
            } 
        }
    }
 } 
} else {
                $msg = 'Problemi con l\'inserimento dei dati %s';
            }  
    printf($msg, '');

?>