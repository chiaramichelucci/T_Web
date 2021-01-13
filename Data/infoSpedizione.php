<?php require '../PDO/infoSpedizionePDO.php' ?>
<?php

    class InfoSpedizione extends InfoSpedizionePDO{

        public $id;
        public $citta;
        public $via;
        public $numero;
        public $cap;
        public $provincia;
        public $paese;
        public $altre_particolarita;
        public $id_ordine;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getCitta(){
            return $this->citta;
        }

        public function setCitta($citta){
            $this->citta = $citta;
        }

        public function getVia(){
            return $this->via;
        }

        public function setVia($via){
            $this->via = $via;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }

        public function getCap(){
            return $this->cap;
        }

        public function setCap($cap){
            $this->cap = $cap;
        }

        public function getProvincia(){
            return $this->provincia;
        }

        public function setProvincia($prov){
            $this->provincia = $prov;
        }

        public function getPaese(){
            return $this->paese;
        }

        public function setPaese($paese){
            $this->paese = $paese;
        }

        public function getAltreParticolarita(){
            return $this->altre_particolarita;
        }

        public function setAltreParticolarita($altre){
            $this->altre_particolarita = $altre;
        }

        public function getIdOrdine(){
            return $this->id_ordine;
        }

        public function setIdOrdine($id_ordine){
            $this->id_ordine = $id_ordine;
        }


    }

?>