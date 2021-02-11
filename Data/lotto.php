<?php require '../PDO/lottoPDO.php' ?>
<?php

    class Lotto extends LottoPDO{

        public $id;
        public $numero;
        public $quantita_disponibile;
        public $scadenza;     
        public $id_prodotto;
        public $id_stabilimento;   

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getNumero(){
            return $this->numero;
        }
        
        public function getQuantitaDisponibile(){
            return $this->quantita_disponibile;
        }

        public function getScadenza(){
            return $this->scadenza;
        }

        public function getIdProdotto(){
            return $this->id_prodotto;
        }

        public function getIdStabilimento(){
            return $this->id_stabilimento;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }
        
        public function setQuantitaDisponibile($quantita){
            $this->quantita_disponibile = $quantita;
        }

        public function setScadenza($sca){
            $this->scadenza = $scadenza;
        }

        public function setIdProdotto($id){
            $this->id_prodotto = $id;
        }
        
        public function setIdStabilimento($id){
            $this->id_stabilimento = $id;
        }

        public function getlotto($id){
            $coso = parent::getLotto($id);
            if($coso == false){
                $this->setId(0);
            }else{
                $this->setId($coso['id']);
                $this->setNumero($coso['numero']);
                $this->setQuantitaDisponibile($coso['quantita_disponibile']);
                $this->setScadenza($coso['scadenza']);
                $this->setIdProdotto($coso['id_prodotto']);
                $this->setIdStabilimento($coso['id_stabilimento']);
            }
        }
    }

?>