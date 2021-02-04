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

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }
    }

?>