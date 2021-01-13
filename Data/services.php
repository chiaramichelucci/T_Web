<?php require '../servicesPDO/PDO.php' ?>
<?php

    class Services extends servicesPDO{

        public $username;
        public $permisions;  

        public function __construct($username, $permisions) {
            $this->username = $username;
            $this->permisions = $permisions;
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