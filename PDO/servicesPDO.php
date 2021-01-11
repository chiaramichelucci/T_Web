<?php

    class ServicesPDO extends Services{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

       function getServices() {
            return $this->conn->query("SELECT username, permisions FROM services")->fetchAll();
        }      

    }

?>