<?php require '../PDO/dettagliNutrizionaliPDO.php' ?>
<?php

    class DettagliNutrizionali extends DettagliNutrizionaliPDO{

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

        public function __construct($db) {
            parent::__construct($db);
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

        public function getDettagliN($id){
            $dn = parent::getId($id);
            if($dn == false){
                $this->setId(0);
            } else {
                $this->setId($dn['id']);
                $this->setIdProdotto($dn['id_prodotto']);
                $this->setEnergia($dn['energia']);
                $this->setGrassi($dn['grassi']);
                $this->setCarboidrati($dn['carboidrati']);
                $this->setProteine($dn['proteine']);
                $this->setSale($dn['sale']);
                $this->setAnidriteCarbonica($dn['anidrite_carbonica']);
                $this->setCalcio($dn['calcio']);
                $this->setSodio($dn['sodio']);

            }
        }
    }

?>