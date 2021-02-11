<?php 

    class OrdinePDO{

        protected $conn;
        protected $table_name = "ordine";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getOrdine($userId){​​
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id_user = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$userId]);
            return $stmt;
        }

        public function getData($userId){
            $sql = "SELECT data FROM " . $this->table_name . " WHERE id_user = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$userId]);
            return $stmt;
        }

        public function getTotale($userId){
            $sql = "SELECT totale FROM " . $this->table_name . " WHERE id_user = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$userId]);
            return $stmt;
        }

        public function getStato($userId){
            $sql = "SELECT stato FROM " . $this->table_name . " WHERE id_user = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$userId]);
            return $stmt;
        }

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }
        
        public function creaOrdine(){
            $sql = "INSERT INTO " . $this->table_name . " (totale, stato, data, id_user)
            VALUES ( ?, ?, ?, ? )";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute(array($this->totale, $this->stato, $this->data, $this->id_user));
            return $stmt;
        }
    }

?>
