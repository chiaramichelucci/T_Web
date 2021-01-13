<?php require '../PDO/ordinePDO.php' ?>
<?php

    class Ordine extends OrdinePDO{

        public $id;
        public $totale;
        public $stato;
        public $data;     
        public $id_user;
        public $id_carrello;   

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getTotale(){
            return $this->totale;
        }
        
        public function getStato(){
            return $this->stato;
        }

        public function getData(){
            return $this->data;
        }

        public function getIdUser(){
            return $this->id_user;
        }

        public function getIdCarrello(){
            return $this->id_carrello;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setTotale(){
            $this->totale;
        }
        
        public function setStato(){
            $this->stato;
        }

        public function setData(){
            $this->data;
        }

        public function setIdUser(){
            $this->id_user;
        }

        public function setIdCarrello(){
            $this->id_carrello;
        }
    }

?>