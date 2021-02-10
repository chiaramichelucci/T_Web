<?php

    require "../Data/user.php";
    require "../Data/opzioneSpedizione.php";
    require "../Data/OpzionePagamento.php";
    require "../PDO/database.php";
    require "../include/template2.inc.php";

    $main = new Template("../dtml/userProfile.html");
    session_start();
	$checkSession = session_status();
	if($checkSession == PHP_SESSION_ACTIVE){
		if(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 1){
			$bar = new Template("../dtml/userBarAdmin.html");
		} elseif(isset($_SESSION['user_group']) && !empty($_SESSION['user_group']) && $_SESSION['user_group'] == 2){
            $bar = new Template("../dtml/userBarGeneric.html");
        }else{
            $bar = new Template("../dtml/userBarUnsigned.html");
        }
    }else{
        $bar = new Template("../dtml/userBarUnsigned.html");
    }
    $main->setContent("userbar", $bar->get());

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    $user->getUser($_SESSION['user_id']);

    $main->setContent("user_nome", $user->nome);
    $main->setContent("user_cognome", $user->cognome);
    $main->setContent("user_email", $user->email);

    $opS = new OpzioneSpedizione($db);
    $opP = new OpzionePagamento($db);
    $opSpedizione = $opS->getOSUser($_SESSION['user_id']);

    while ($data = $opSpedizione->fetch(PDO::FETCH_ASSOC)){
        $data['id_spedizione'] = $data['id'];
        unset($data['id']);
        foreach($data as $key => $value){
            $main->setContent($key, $value);
        }
    }

    $opPagamento = $opP->getOPUser($_SESSION['user_id']);

    while ($data = $opPagamento->fetch(PDO::FETCH_ASSOC)){
        $data['id_pagamento'] = $data['id'];
        unset($data['id']);
        foreach($data as $key => $value){
            $main->setContent($key, $value);
        }
    }

    $opS = new OpzioneSpedizione($db);

    $main->close();

    array_walk($array, function (& $item) {
        $item['id_sped'] = $item['id'];
        unset($item['id']);
     });
?>