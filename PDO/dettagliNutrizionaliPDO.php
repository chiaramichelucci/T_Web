<?php

    class DettagliNutrizionaliPDO extends DettagliNutrizionali{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

       function getDettagliNutrizionali() {
            return $this->conn->query("SELECT id, id_prodotto, energia, grassi, carboidrati, proteine, sale, anidrite_carbonica, calcio, sodio 
            FROM dettagli_nutrizionali")->fetchAll();
        }      

    }

?>