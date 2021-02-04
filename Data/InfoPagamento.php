<?php require '../PDO/InfoPagamentoPDO.php' ?>
<?php

    class InfoPagamento extends InfoPagamentoPDO{

        public $id;
        public $id_ordine;
        public $modalita;
        public $numero_carta;
        public $scadenza;
        public $cvv;
        
        
        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getIdOrdine(){
            return $this->id_ordine;
        }

        public function getModalita(){
            return $this->modalita;
        }

        public function getNumeroCarta(){
            return $this->numero_carta;
        }

        public function getScadenza(){
            return $this->scadenza;
        }

        public function getCvv(){
            return $this->cvv;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdOrdine($id_ordine){
            $this->id_ordine = $id_ordine;
        }

        public function setModalita($modalita){
            $this->modalita = $modalita;
        }

        public function setNumeroCarta($numero_carta){
            $this->numero_carta = $numero_carta;
        }

        public function setScadenza($scadenza){
            $this->scadenza = $scadenza;
        }
        
        public function setCvv($cvv){
            $this->cvv = $cvv;
        }

        public function getInfoPag($id){
            $ip = parent::getId($id);
            if($ip == false){
                $this->setId(0);
            } else {
                $this->setId($ip['id']);
                $this->setIdOrdine($ip['id_ordine']);
                $this->setModalita($ip['modalita']);
                $this->setNumeroCarta($ip['numero_carta']);
                $this->setScadenza($ip['scadenza']);
                $this->setCvv($ip['cvv']);
                
            }
        }

    }

?>