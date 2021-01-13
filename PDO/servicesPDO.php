<?php

    class ServicesPDO{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

       function getServices() {
            return $this->conn->query("SELECT username, permisions FROM services")->fetchAll();
        }      

    }

?>