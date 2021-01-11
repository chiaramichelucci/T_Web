<?php

    class DettagliNutrizionali{

        public $id;
        public $id_prodotto;
        public $energia;
        public $grassi;
        public $carboidrati;     
        public $proteine;
        public $sale;  
        public $anidrite_carbonica; 
        public $calcio;
        public $sodio;

        public function __construct($id_prodotto, $energia, $grassi, $carboidrati, $proteine, $sale, $anidrite_carbonica, $calcio, $sodio) {
            $this->id_prodotto = $id_prodotto;
            $this->energia = $energia;
            $this->grassi = $grassi;
            $this->carboidrati = $carboidrati;
            $this->proteine = $proteine;
            $this->sale = $sale;
            $this->anidrite_carbonica = $anidrite_carbonica;
            $this->calcio = $calcio;
            $this->sodio = $sodio;
        }

        public function getId(){
            return $this->id;
        }

        public function getIdProdotto(){
            return $this->id_prodotto;
        }

        public function getEnergia(){
            return $this->energia;
        }

        public function getGrassi(){
            return $this->grassi;
        }

        public function getCarboidrati(){
            return $this->carboidrati;
        }

        public function getProteine(){
            return $this->proteine;
        }
        
        public function getSale(){
            return $this->sale;
        }

        public function getAnidriteCarbonica(){
            return $this->anidrite_carbonica;
        }

        public function getCalcio(){
            return $this->calcio;
        }

        public function getSodio(){
            return $this->sodio;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdProdotto(){
            $this->id_prodotto;
        }

        public function setEnergia(){
            $this->energia;
        }

        public function setGrassi(){
            $this->grassi;
        }

        public function setCarboidrati(){
            $this->carboidrati;
        }

        public function setProteine(){
            $this->proteine;
        }
        
        public function setSale(){
            $this->sale;
        }

        public function setAnidriteCarbonica(){
            $this->anidrite_carbonica;
        }

        public function setCalcio(){
            $this->calcio;
        }

        public function setSodio(){
            $this->sodio;
        }
    }

?>