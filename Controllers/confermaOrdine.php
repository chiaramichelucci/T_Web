<?php

    require "../PDO/database.php";
    require "../include/template2.inc.php";
    require "../Data/carrello.php";
    require "../Data/infoSpedizione.php";
    require "../Data/infoPagamento.php";
    require "../Data/opzionePagamento.php";
    require "../Data/ordine.php";
    require "../Data/user.php";
    require '../Data/opzioneSpedizione.php';
    require '../Data/prodottoInOrdine.php';

    session_start();

    $database = new Database();       
    $db = $database->getConnection();
    $carrello = new Carrello($db);
    $opzSped = new OpzioneSpedizione($db);
    $infoSped = new InfoSpedizione($db);  
    $infoPag = new InfoPagamento($db);
    $ordine = new Ordine($db);
    $user = new User($db);
    $opzPag = new opzionePagamento($db);
    $prodINOrd= new prodottoInOrdine($db);

    //creazione ordine
    $ordine->stato = 'In preparazione';
    $ordine->data = date('Y/m/d-H:i:s');
    $ordine->id_user = $_SESSION['id_user'];
    $ordine->totale = $carrello->getTotale();
    $ordineEffettuato = $ordine->creaOrdine($ordine->stato, $ordine->data, $ordine->id_user, $ordine->totale); //metodo che restituisce il risultato dell'inserimento come array (DA FARE)
    $id_ordine = $ordineEffettuato['id'];

    //verifica tipo di pagamento (alla consegna; carta; paypal) e creazione informazioni di pagamento per l'ordine
    if(isset($_POST['PAC'])){

        $infoPag->modalita = 'Pagamento alla consegna';
        $infoPag->numero_carta = '';
        $infoPag->scadenza = '';
        $infoPag->cvv = '';
        $infoPag->nome_proprietario = '';

    } elseif (isset($_POST['pagCarta'])){

        $infoPag->modalita = 'Carta';
        $infoPag->numero_carta = $_POST['numero_carta'];
        $infoPag->scadenza = $_POST['scadenza'];
        $infoPag->cvv = $_POST['cvv'];
        $infoPag->nome_proprietario = $_POST['nome_proprietario'];


    } elseif (isset($_POST['pagPayPal'])){

        $infoPag->modalita = 'PayPal';
        $infoPag->numero_carta = $_POST['numero_cartapp'];
        $infoPag->scadenza = $_POST['scadenzapp'];
        $infoPag->cvv = $_POST['cvvpp'];
        $infoPag->nome_proprietario = $_POST['nome_proprietariopp'];

        
    } 

    $infoPag->creaInfoPag($id_ordine, 
                          $infoPag->$modalita, 
                          $infoPag->$numero_carta, 
                          $infoPag->$scadenza, 
                          $infoPag->$cvv, 
                          $infoPag->nome_proprietario); //da fare
    
    //eventuale aggiunta alle proprie carte
    if (isset($_POST['aggAlleMieCarte'])){
        
        $opzPag->creaOpzionePagamento($infoPag->numero_carta, 
                                      $infoPag->scadenza, 
                                      $infoPag->cvv, 
                                      $nome_proprietario, 
                                      $infoPag->nome_proprietario, 
                                      $_SESSION['id_user']);
        
    }

    //creazione informazioni di spedizione
    if (isset($_POST['id_indirizzo'])){

        $indirizzo = $opzSped->getById($_POST['id_indirizzo']);//da fare
        $infoSped->creaInfoSped($id_ordine, 
                                $indirizzo['citta'], 
                                $indirizzo['via'], 
                                $indirizzo['numero'], 
                                $indirizzo['cap'], 
                                $indirizzo['provincia'], 
                                $indirizzo['paese'], 
                                $indirizzo['altre_particolarita']);

    } else {

        $infoSped->creaInfoSped($id_ordine, 
                                $_POST['citta'], 
                                $_POST['via'], 
                                $_POST['numero'], 
                                $_POST['cap'], 
                                $_POST['provincia'], 
                                $_POST['paese'], 
                                $_POST['altre_particolarita']);
        
        if(isset($_POST['aggAiMieiInd'])){

            $opzSped->creaOpzSped($_POST['citta'],
                                  $_POST['via'],
                                  $_POST['numero'], 
                                  $_POST['cap'], 
                                  $_POST['provincia'], 
                                  $_POST['paese'], 
                                  $_POST['altre_particolarita'], 
                                  $_SESSION['id_user']);

        }
    } 
    
    //creazione prodotti in ordine
    $prodotti = $carrello->getByUserID($_SESSION['id_user']);//lista prodotti nel carrello 
    $cont = 0;
    while ($cont < $prodotti->rowCount()){

        $prodotto = $prodotti->fetch(PDO::FETCH_ASSOC); //iterazione sui prodotti
        $prodINOrd->aggProdInOrd($id_ordine, $prodotto['id_prodotto'], $prodotto['quantita']);
        $cont++;
        
    } 

    $carrello->svuotaCarrello();//da fare
    $main = new Template("../dtml/loggedUserMain.html");
    $body = new Template("../dtml/riepilogoOrdine.html");
    //main e body set content
    
    $main->close();

?>

