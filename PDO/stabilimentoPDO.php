<?php

    class StabilimentoPDO extends Stabilimento{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

       function getStabilimenti() {
            return $this->conn->query("SELECT id, id_produttore, nome, città, via, numero, cap, provincia, paese FROM stabilimento")->fetchAll();
        }      

    }

?>