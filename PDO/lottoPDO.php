<?php 

    class LottoPDO{

        protected $conn;
        protected $table_name = "lotto";

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