<?php

    class InfoSpedizionePDO extends InfoSpedizione{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

        //da aggiungere qua tutte le funzioni mysql per l'oggetto info spedizione

        function getopzioniSpedizione() {
            return $this->conn->query("SELECT * FROM info_spedizione")->fetchAll();
        } 

    }

?>