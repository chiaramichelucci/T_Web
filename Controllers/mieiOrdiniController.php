<?php

    require "../PDO/database.php";
    require "../include/template2.inc.php";
    require "../Data/user.php";
    require "../Data/Ordine.php";

    $main = new Template("../dtml/mieiOrdini.html");
    $card = new Template("../dtml/index.html"); //pagina comune

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    $ordine = new Ordine($db);

    $id->id_user = $_SESSION['id_user'];
    $data = $ordine-> getData($id); 
    $totale = $ordine-> getTotale($id);
    $stato = $ordine-> getStato($id);


    $main->close();

?>