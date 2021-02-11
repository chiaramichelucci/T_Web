<?php
   
   require "../PDO/database.php";
   require "../include/template2.inc.php";
   require "../Data/carrello.php";

   session_start();
   
   $database = new Database();       
   $db = $database->getConnection();
   $carrello = new Carrello($db);


   $carrello->id_prodotto = $_POST['id_prodotto'];
   $carrello->id_user = $_SESSION['user_id'];
   $carrello->quantita = 1;
   $carrello->aggiungiAlCarrello();

   $carrello->viewCart($_SESSION['user_id']);
   $main = new Template("../dtml/checkoutLogInd.html");
   //set content
   $main->close();

?>