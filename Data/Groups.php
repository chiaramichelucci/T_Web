<?php require '../PDO/GroupsPDO.php' ?>
<?php

    class Groups extends GroupsPDO{

        public $id;
        public $denominazione;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getDenominazione(){
            return $this->denominazione;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setDenominazione($denominazione){
            $this->denominazione = $denominazione;
        }

    }

?>