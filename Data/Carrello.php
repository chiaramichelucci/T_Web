<?php require '../PDO/CarrelloPDO.php' ?>
<?php

    class Carrello extends CarrelloPDO{

        public $id;
        public $id_prodotto;
        public $id_user;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getIdProdotto(){
            return $this->id_prodotto;
        }

        public function getIdUser(){
            return $this->id_user;
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

        public function getCerrello($id){
            $carr = parent::getId($id);
            if($carr == false){
                $this->setId(0);
            } else {
                $this->setId($carr['id']);
                $this->setIdProdotto($carr['id_prodotto']);
                $this->setIdUser($carr['id_user']);
            }
        }

    }

?>