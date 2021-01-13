<?php require '../PDO/stabilimentoPDO.php' ?>
<?php

    class Stabilimento extends StabilimentoPDO{

        public $id;
        public $id_produttore;
        public $nome;
        public $città;
        public $via;     
        public $numero;
        public $cap;  
        public $provincia; 
        public $paese;

        public function __construct($db) {
            parent::__construct($db);
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