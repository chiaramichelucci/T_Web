<?php

    require "../include/template2.inc.php";
    require "../Data/Prodotto.php";
    require "../PDO/database.php";

    session_start();
	$checkSession = session_status();
    $error = new Template("../dashboard/pages/error.html");
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			
            $database = new Database();
            $db = $database->getConnection();
            $prodotto = new Prodotto($db);
            $prodotto->nome = $_POST['nome_prod'];
            $prodotto->prezzo = $_POST['prezzo_prod'];
            if(isset($_POST['sconto_prod'])){
                $prodotto->sconto = $_POST['sconto_prod'];
            }else{
                $prodotto->sconto = "";
            }
            $prodotto->descrizione = $_POST['desc_prod'];
            $prodotto->id_categoria = $_POST['cat_prod'];
            $prodotto->id_produttore = $_POST['prod_prod'];

            $status = $prodotto->registerProdotto();
            if(!$status){
                $error->setContent("msgErrore", "Registrazione Falita");
            }
            header("Location: adminDashboard.php");
            
		} elseif(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 2){
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }else{
            $error->setContent("msgErrore", "Non hai permesso qui");
            $error->close();
        }
    }else{
        $error->setContent("msgErrore", "Non hai permesso qui");
        $error->close();
    }


?>
