<?php

    class ProduttorePDO{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

        //da aggiungere qua tutte le funzioni mysql per l'oggetto categoria

        function getCategorie() {
            return $this->conn->query("SELECT * FROM prodotto")->fetchAll();
        } 

    }

?>