<?php

    class OpzioneSpedizione{

        public $id;
        public $citta;
        public $via;
        public $numero;
        public $cap;
        public $provincia;
        public $paese;
        public $altre_particolarita;
        public $id_utente;

        public function __construct($citta, $via, $nr, $cap, $prov, $paese, $altre, $id_utente) {
            $this->citta = $citta;
            $this->via = $via;
            $this->numero = $nr;
            $this->cap = $cap;
            $this->provincia = $prov;
            $this->paese = $paese;
            $this->altre_particolarita = $altre;
            $this->id_utente = $id_utente;
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


    }

?>