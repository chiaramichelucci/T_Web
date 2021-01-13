<?php

    class ImmaginePDO{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

       function getImmagine() {
            return $this->conn->query("SELECT id, id_prodotto, uri FROM immagine")->fetchAll();
        }      

    }

?>