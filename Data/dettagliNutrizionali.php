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

        public function setIdProdotto($id_prodotto){
            $this->id_prodotto = $id_prodotto;
        }

        public function setEnergia($energia){
            $this->energia = $energia;
        }

        public function setGrassi($grassi){
            $this->grassi = $grassi;
        }

        public function setCarboidrati($carb){
            $this->carboidrati = $carb;
        }

        public function setProteine($proteine){
            $this->proteine = $proteine;
        }
        
        public function setSale($sale){
            $this->sale = $sale;
        }

        public function setAnidriteCarbonica($ani){
            $this->anidrite_carbonica = $ani;
        }

        public function setCalcio($calcio){
            $this->calcio = $calcio;
        }

        public function setSodio($sodio){
            $this->sodio = $sodio;
        }

        public function getDettagliN($id){
            $dn = parent::getDettagliN($id);
            if($dn == false){
                $this->setId(0);
            } else {
                $this->setId($dn['id']);
                $this->setIdProdotto($dn['id_prodotto']);
                if($dn['energia'] != NULL && $dn['energia'] != ""){ $this->setEnergia($dn['energia']); } else { $this->setEnergia(0); }
                if($dn['grassi'] != NULL && $dn['grassi'] != ""){ $this->setGrassi($dn['grassi']); } else { $this->setGrassi(0); }
                if($dn['carboidrati'] != NULL && $dn['carboidrati'] != ""){ $this->setCarboidrati($dn['carboidrati']); } else { $this->setCarboidrati(0); }
                if($dn['proteine'] != NULL && $dn['proteine'] != ""){ $this->setProteine($dn['proteine']); } else { $this->setProteine(0); }
                if($dn['sale'] != NULL && $dn['sale'] != ""){ $this->setSale($dn['sale']); } else { $this->setSale(0); }
                if($dn['anidrite_carbonica'] != NULL && $dn['anidrite_carbonica'] != ""){ $this->setAnidriteCarbonica($dn['anidrite_carbonica']); } else { $this->setAnidriteCarbonica(0); }
                if($dn['calcio'] != NULL && $dn['calcio'] != ""){ $this->setCalcio($dn['calcio']); } else { $this->setCalcio(0); }
                if($dn['sodio'] != NULL && $dn['sodio'] != ""){ $this->setSodio($dn['sodio']); } else { $this->setSodio(0); }

            }
        }
    }

?>