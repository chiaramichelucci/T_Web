<?php require '../produttorePDO/PDO.php' ?>
<?php

    class Produttore extends produttorePDO{

        public $id;
        public $ragione_sociale;
        public $partita_iva;
        public $prefisso;
        public $numero_verde;
        public $email;
        public $sito;

        public function __construct($rs, $piva, $prefisso, $nv, $email, $sito) {
            $this->ragione_sociale = $rs;
            $this->partita_iva = $piva;
            $this->prefisso = $prefisso;
            $this->numero_verde = $nv;
            $this->email = $email;
            $this->sito = $sito;
        }

        public function getID(){
            return $this->id;
        }

        public function getRagioneSociale(){
            return $this->ragione_sociale;
        }

        public function setRagioneSociale($rs){
            $this->ragione_sociale = $rs;
        }

        public function getPartitaIVA(){
            return $this->partita_iva;
        }

        public function setPartitaIVA($piva){
            $this->partita_iva = $piva;
        }

        public function getPrefisso(){
            return $this->prefisso;
        }

        public function setPrefisso($pref){
            $this->prefisso = $pref;
        }

        public function getNumeroVerde(){
            return $this->numero_verde;
        }

        public function setNumeroVerde($numero_verde){
            $this->numero_verde = $numero_verde;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getSito(){
            return $this->sito;
        }

        public function setSito($sito){
            $this->sito = $sito;
        }
    }

?>