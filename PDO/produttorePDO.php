<?php 

    class ProduttorePDO{

        protected $conn;
        protected $table_name = "produttore";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }
    }

?>