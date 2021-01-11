<?php

    class Immagine{

        public $id;
        public $id_prodotto;
        public $uri;        

        public function __construct($id_prodotto, $uri) {
            $this->id_prodotto = $id_prodotto;
            $this->uri = $uri;
        }

        public function getId(){
            return $this->id;
        }

        public function getIdProdotto(){
            return $this->id_prodotto;
        }
        
        public function getUri(){
            return $this->uri;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdProdotto(){
            $this->id_prodotto;
        }
        
        public function setUri(){
            $this->uri;
        }
    }

?>