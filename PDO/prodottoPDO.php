<?php 

    class ProdottoPDO{

        protected $conn;
        protected $table_name = "prodotto";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getProdotti(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }
    }

?>