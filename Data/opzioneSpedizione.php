<?php require '../PDO/opzioneSpedizionePDO.php' ?>
<?php

    class OpzioneSpedizione extends OpzioneSpedizionePDO{

        public $id;
        public $citta;
        public $via;
        public $numero;
        public $cap;
        public $provincia;
        public $paese;
        public $altre_particolarita;
        public $id_utente;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getID(){
            return $this->id;
        }

        public function setID($id){
            $this->id = $id;
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

        public function getIdUtente(){
            return $this->id_utente;
        }

        public function setIdUtente($id_utente){
            $this->id_utente = $id_utente;
        }

        public function aggiungiOpzioneSpedizione(){
            $status = parent::aggiungiOpzioneSpedizione();
            return $status;
        }

        public function getOpzione($id){
            $opzione = parent::getOpzione($id);
            if($opzione == false){
                $this->setId(0);
            } else {
                $this->setID($coso['id']);
                $this->setCitta($coso['citta']);
                $this->setVia($coso['via']);
                $this->setNumero($coso['numero']);
                $this->setCap($coso['cap']);
                $this->setProvincia($coso['provincia']);
                $this->setPaese($coso['paese']);
                $this->setAltreParticolarita($coso['altre_particolarita']);
                $this->setIdUtente($coso['id_user']);
            }
        }

        public function modificaOpzionoSpedizione($id){
            $status = parent::modificaOpzionoSpedizione($id);
            return $status;
        }

        public function cancellaOpzioneSpedizione($id){
            $status = parent::cancellaOpzioneSpedizione($id);
            return $status;
        }

    }

?>