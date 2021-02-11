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

        public function getProdotto($idUser){
            $sql = "SELECT id_prodotto FROM " . $this->table_name . " WHERE id_user = ?";
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
        
        public function svuotaCarrello($id_user){
            $query = "DELETE FROM " . $this->table_name . " WHERE id_user = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$id_user]);
            return $stmt;
        }
        
        public function aggiungiAlCarrello(){
            $query = "INSERT INTO " . $this->table_name . " (id_prodotto, quantita, id_user)
            VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute(array($this->id_prodotto, $this->quantita, $this->id_user));
            return $stmt;
        }


    }

?>
