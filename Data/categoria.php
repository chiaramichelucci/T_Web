<?php

    class Categoria{

        public $id;
        public $nome;

        public function __construct($nome) {
            $this->nome = $nome;
        }

        public function getID(){
            return $this->id;
        }

        public function setID($id){
            $this->id = $id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }
    }

?>