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
    require '../Data/lotto.php';

    session_start();

    $database = new Database();       
    $db = $database->getConnection();
    $carrello = new Carrello($db);
    $opzSped = new OpzioneSpedizione($db);
    $infoSped = new InfoSpedizione($db);  
    $infoPag = new InfoPagamento($db);
    $ordine = new Ordine($db);
    $user = new User($db);
    $opzPag = new OpzionePagamento($db);
    $prodINOrd = new ProdottoInOrdine($db);
    $lotto = new Lotto($db);

    //creazione ordine
    $ordine->stato = 'In preparazione';
    $ordine->data = date('Y/m/d-H:i:s');
    $ordine->id_user = $_SESSION['id_user'];
    $ordine->totale = $carrello->getTotale();
    $ordineEffettuato = $ordine->creaOrdine()->fetch(PDO::FETCH_ASSOC);; //risultato dell'inserimento come array 
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

    $infoPag->creaInfoPag($id_ordine); 
                           
    
    //eventuale aggiunta alle proprie carte
    if (isset($_POST['aggAlleMieCarte'])){

        $opzPag->id_user = $_SESSION['id_user'];
        $opzPag->tipologia = $infoPag->modalita;
        $opzPag->numero_carta = $infoPag->numero_carta;
        $opzPag->scadenza = $infoPag->scadenza;
        $opzPag->cvv = $infoPag->cvv;
        $opzPag->nome_proprietario = $infoPag->nome_proprietario;
        $opzPag->aggiungiOpzionePagamento();
        
    }

    //creazione informazioni di spedizione
    if (isset($_POST['id_indirizzo'])){

        $indirizzo = $opzSped->getOpzione($_POST['id_indirizzo'])->fetch(PDO::FETCH_ASSOC); // indirizzo relativo a $_POST['id_indirizzo']
        $infoSped->citta = $indirizzo['citta']; 
        $infoSped->via = $indirizzo['via']; 
        $infoSped->numero = $indirizzo['numero'];
        $infoSped->cap = $indirizzo['cap']; 
        $infoSped->provincia = $indirizzo['provincia']; 
        $infoSped->paese = $indirizzo['paese']; 
        $infoSped->altre_particolarita = $indirizzo['altre_particolarita'];
        $infoSped->creaInfoSped($id_ordine);

    } else {

        $infoSped->citta = $_POST['citta']; 
        $infoSped->via = $_POST['via']; 
        $infoSped->numero = $_POST['numero']; 
        $infoSped->cap = $_POST['cap']; 
        $infoSped->provincia = $_POST['provincia']; 
        $infoSped->paese = $_POST['paese']; 
        $infoSped->altre_particolarita = $_POST['altre_particolarita'];
        $infoSped->creaInfoSped($id_ordine); 
        
        if(isset($_POST['aggAiMieiInd'])){

            $opzSped->citta = $_POST['citta'];
            $opzSped->via = $_POST['via'];
            $opzSped->numero = $_POST['numero']; 
            $opzSped->cap = $_POST['cap']; 
            $opzSped->paese = $_POST['provincia']; 
            $opzSped->paese = $_POST['paese']; 
            $opzSped->altre_particolarita = $_POST['altre_particolarita']; 
            $opzSped->id_user = $_SESSION['id_user'];
            $opzSped->aggiungiOpzioneSpedizione();

        }
    } 
    
    //creazione prodotti in ordine
    $prodotti = $carrello->viewCart($_SESSION['id_user']);//lista prodotti nel carrello dell'utente
    $cont = 0;
    while ($cont < $prodotti->rowCount()){

        $prodotto = $prodotti->fetch(PDO::FETCH_ASSOC); //iterazione sui prodotti nel carrello (contiene il prodotto attuale)
        //$prodINOrd prende i dati del prodotto del carrello 
        $prodINOrd->id_ordine = $id_ordine;
        $prodINOrd->id_prodotto = $prodotto['id_prodotto'];
        $lotti_prod = $lotto->get($prodotto['id_prodotto']);//lotti relativi al prodotto (in ordine ascendente rispetto alla data di scadenza)
        
        //ciclo che crea i prodotti in ordine scalando la loro quantità da quella dei relativi lotti
        while ($prodotto['quantita'] != 0){

            $lotto_att = $lotti_prod->fetch(PDO::FETCH_ASSOC); //lotto attuale
            if ($lotto_att['quantita_disponibile'] >= $prodotto['quantita']){ //la quantità del lotto attua

                $lotto_att['quantita_disponibile'] -= $prodotto['quantita'];
                //aggiornamento lotto
                $lotto->id = $lotto_att['id'];
                $lotto->aggiornaQtaDisp( $lotto_att['quantita_disponibile']);
                //crea prodotto in ordine con i dati del lotto attuale
                $prodINOrd->quantita = $prodotto['quantita'];
                $prodINOrd->id_lotto = $lotto_att['id'];
                $prodINOrd->creaProdInOrd();
                $prodotto['quantita'] = 0;

            } else {

                $prodINOrd->quantita = $lotto_att['quantita_disponibile'];
                $prodINOrd->id_lotto = $lotto_att['id'];
                $prodINOrd->creaProdInOrd();
                $prodotto['quantita'] -= $lotto_att['quantita_disponibile'];
                $lotto_att['quantita_disponibile'] = 0;
                $lotto->aggiornaQtaDisp( $lotto_att['quantita_disponibile']);

            }
            
        }
        
    } 

    $carrello->svuotaCarrello($_SESSION['id_user']);
    $main = new Template("../dtml/loggedUserMain.html");
    $body = new Template("../dtml/riepilogoOrdine.html");
    //main e body set content
    
    $main->close();

?>
