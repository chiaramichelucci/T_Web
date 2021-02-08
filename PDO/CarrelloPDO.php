<?php

    class CarrelloPDO{

        protected $conn;
        protected $table_name = "carrello";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getCarrello($idUser){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id_user = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$idUser]);
            return $stmt;
        }  
        
        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }

        public function viewCart($id_user){
            $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$id_user]);
            return $stmt;
        }

    }

?>