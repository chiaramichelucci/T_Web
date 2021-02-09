<?php require '../PDO/RecensionePDO.php' ?>
<?php

    class Recensione extends RecensionePDO{

        public $id;
        public $id_user;
        public $id_prodotto;
        public $titolo;
        public $voto;
        public $testo;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getIdUser(){
            return $this->id_user;
        }

        public function getIdProdotto(){
            return $this->id_prodotto;
        }
        public function getTitolo(){
            return $this->titolo;
        }

        public function getVoto(){
            return $this->voto;
        }

        public function getTesto(){
            return $this->testo;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdProdotto($id_prodotto){
            $this->id_prodotto = $id_prodotto;
        }

        public function setIdUser($id_user){
            $this->id_user = $id_user;
        }
        public function setTitolo($titolo){
            $this->titolo = $titolo;
        }

        public function setVoto($voto){
            $this->voto = $voto;
        }

        public function setTesto($testo){
            $this->testo = $testo;
        }

    }

?>