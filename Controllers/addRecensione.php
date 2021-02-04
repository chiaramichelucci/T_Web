<?php
require "../PDO/database.php";
require "../Data/user.php";
require "../Data/prodotto.php";
require "../Data/recensione.php";
require "../include/template2.inc.php";

$main = new Template("../dtml/singoloProdotto.html");

$failed = false;


while (!$failed) {

    if (isset($_POST['Titolo']) && !empty($_POST['Titolo'])) {
        $titolo = $_POST['Titolo'];
    }
    else {
        $msg = "Titolo mancante";
        $failed = true;
    }
    if (isset($_POST['Voto']) && !empty($_POST['Voto'])) {
        $voto = $_POST['Voto'];
    }
    else if (isset($_POST['Testo']) && !empty($_POST['Testo'])) {
       $testo = $_POST['Testo'];
    }
    else {
        $msg = "Testo mancante";
        $failed = true;
    }


    $database = new Database();
    $db = $database->getConnection(); 

    $prodotto = new Prodotto($db);
    $user = new User($db);
    $addRec = new Recensione($db);

    $id_user = $user->getUser($_SESSION['user_id']);
    $id_prod = $prod->getProdotto($_SESSION['prodotto_id']);

    $rec = $addRec->addRecens($id_user, $id_prod, $titolo, $voto, $testo);
    $msg = "Recensione inserita correttamente!";

        
    if($failed = true){
        callErrorTemplate($msg);
    }

        
    function callErrorTemplate($errore){
        $error = new Template("../dtml/error.html");
        $error->setContent("msgError", $errore);
        $error->close();
    }

    $main->close();

}
?>