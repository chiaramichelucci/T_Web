<?php require '../PDO/servicesPDO.php' ?>
<?php

    class Services extends ServicesPDO{

        public $username;
        public $permisions;  

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getUsername(){
            return $this->username;
        }

        public function getPermisions(){
            return $this->permisions;
        }

        public function setUsername($username){
            $this->username = $username;
        }

        public function setPermisions(){
            $this->permisions;
        }

    }

?>