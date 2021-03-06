<?php require '../PDO/produttorePDO.php' ?>
<?php

    class Produttore extends ProduttorePDO{

        public $id;
        public $ragione_sociale;
        public $partita_iva;
        public $prefisso;
        public $numero_verde;
        public $email;
        public $sito;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getID(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
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

        public function getProduttore($id){
            $rs = parent::getById($id);
            if($rs == false){
                $this->setId(0);
            } else {
                $coso = $rs->fetch(PDO::FETCH_ASSOC);
                $this->setId($coso['id']);
                $this->setNumeroVerde($coso['numero_verde']);
                $this->setRagioneSociale($coso['ragione_sociale']);
                $this->setPrefisso($coso['prefisso']);
                $this->setPartitaIVA($coso['partita_iva']);
                $this->setEmail($coso['email']);
                $this->setSito($coso['sito']);
            }
        }
    }

?>