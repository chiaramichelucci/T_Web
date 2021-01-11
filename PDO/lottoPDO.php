<?php

    class LottoPDO extends Lotto{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

       function getLotti() {
            return $this->conn->query("SELECT id, numero, quantita_disponibile, scadenza, id_prodotto, id_stabilimento FROM lotto")->fetchAll();
        }      

    }

?>