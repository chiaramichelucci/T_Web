<?php

    class CarrelloPDO{

        protected $conn;
        protected $table_name = "carrello";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getCarrello(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }      

    }

?>