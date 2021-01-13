<?php

    class OrdinePDO{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

       function getOrdini() {
            return $this->conn->query("SELECT id, totale, stato, data, id_user, id_carrello FROM ordine")->fetchAll();
        }      

    }

?>