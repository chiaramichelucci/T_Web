<?php

    class ProdottoPDO extends Prodotto{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

        //da aggiungere qua tutte le funzioni mysql per l'oggetto prodotto

       function getProdotti() {
            return $this->conn->query("SELECT * FROM prodotto")->fetchAll();
        }

        function getProdotto($id) {
            return $this->conn->query("SELECT * FROM prodotto WHERE id \= ". $id)->fetchAll();
        }

        function deleteProdotto($id) {
            return $this->conn->exec("DELETE FROM prodotto WHERE id \= ". $id);
        }

        function modProdotti() {
            return $this->conn->exec("SELECT * FROM prodotto");
        }
        
        
    }
?>