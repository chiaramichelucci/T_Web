<?php

    class RecensionePDO{

        protected $conn;
        protected $table_name = "recensione";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getRecensione(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }    

    }

?>