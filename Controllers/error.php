<?php

    require "include/template2.inc.php";

    $main = new Template("../dtml/mainFrame.html"); 	// template principale comune a tutte le pagine del sito
    $error = new Template("../dtml/error.html");

    $main->setContent("msgError", $bar->get());
    $main->close();

?>