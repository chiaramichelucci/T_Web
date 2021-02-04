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
            $coso = parent::getOpzione($id);
            $opzione = $coso->fetch(PDO::FETCH_ASSOC);
            if($opzione == false){
                $this->setId(0);
            } else {
                $this->setID($opzione['id']);
                $this->setCitta($opzione['citta']);
                $this->setVia($opzione['via']);
                $this->setNumero($opzione['numero']);
                $this->setCap($opzione['cap']);
                $this->setProvincia($opzione['provincia']);
                $this->setPaese($opzione['paese']);
                $this->setAltreParticolarita($opzione['altre_particolarita']);
                $this->setIdUtente($opzione['id_user']);
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