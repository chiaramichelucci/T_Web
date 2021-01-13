<?php

    class OpzioneSpedizionePDO{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

        //da aggiungere qua tutte le funzioni mysql per l'oggetto opzione spedizione

        function getopzioniSpedizione() {
            return $this->conn->query("SELECT * FROM opzione_spedizione")->fetchAll();
        } 

    }

?>