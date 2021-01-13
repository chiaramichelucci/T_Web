<?php require '../PDO/lottoPDO.php' ?>
<?php

    class Lotto extends lottoPDO{

        public $id;
        public $numero;
        public $quantita_disponibile;
        public $scadenza;     
        public $id_prodotto;
        public $id_stabilimento;   

        public function __construct($numero, $quantita_disponibile, $scadenza, $id_prodotto, $id_stabilimento) {
            $this->numero = $numero;
            $this->quantita_disponibile = $quantita_disponibile;
            $this->scadenza = $scadenza;
            $this->id_prodotto = $id_prodotto;
            $this->id_stabilimento = $id_stabilimento;
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

        public function setNumero(){
            $this->numero;
        }
        
        public function setQuantitaDisponibile(){
            $this->quantita_disponibile;
        }

        public function setScadenza(){
            $this->scadenza;
        }

        public function setIdProdotto(){
            $this->id_prodotto;
        }
        
        public function setIdStabilimento(){
            $this->id_stabilimento;
        }
    }

?>