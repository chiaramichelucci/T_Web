<?php

    class Stabilimento{

        public $id;
        public $id_produttore;
        public $nome;
        public $città;
        public $via;     
        public $numero;
        public $cap;  
        public $provincia; 
        public $paese;

        public function __construct($id_produttore, $nome, $città, $via, $numero, $cap, $provincia, $paese) {
            $this->id_produttore = $id_produttore;
            $this->nome = $nome;
            $this->città = $città;
            $this->via = $via;
            $this->numero = $numero;
            $this->cap = $cap;
            $this->provincia = $provincia;
            $this->paese = $paese;
        }

        public function getId(){
            return $this->id;
        }

        public function getIdProduttore(){
            return $this->id_produttore;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getCittà(){
            return $this->città;
        }

        public function getVia(){
            return $this->via;
        }

        public function getNumero(){
            return $this->numero;
        }
        
        public function getCap(){
            return $this->cap;
        }

        public function getProvincia(){
            return $this->provincia;
        }

        public function getPaese(){
            return $this->paese;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdProduttore(){
            $this->id_produttore;
        }

        public function setNome(){
            $this->nome;
        }

        public function setCittà(){
            $this->città;
        }

        public function setVia(){
            $this->via;
        }

        public function setNumero(){
            $this->numero;
        }
        
        public function setCap(){
            $this->cap;
        }

        public function setProvincia(){
            $this->provincia;
        }

        public function setPaese(){
            $this->paese;
        }
    }

?>