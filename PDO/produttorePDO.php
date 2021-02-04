<?php 

    class ProduttorePDO{

        protected $conn;
        protected $table_name = "produttore";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getProduttore($produttoreId){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$userId]);
            $num = $stmt->rowCount();
            print_r($num);
            if($num == 0){
                return false;
            } else {
                $produttore = $stmt->fetch(PDO::FETCH_ASSOC);
                return $produttore;
            }
        }

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }
    }

?>