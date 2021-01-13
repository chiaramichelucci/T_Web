<?php

    class GroupHasServicesPDO{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

        //da aggiungere qua tutte le funzioni mysql per l'oggetto GroupHasServices

        function getGroupHasServices() {
            return $this->conn->query("SELECT * FROM services_has_groups")->fetchAll();
        } 

    }

?>