<?php 

    class StabilimentoPDO{

        protected $conn;
        protected $table_name = "stabilimento";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            if($stmt->execute()){
                return $stmt;
            }else{
                return false;
            }
            
        }

        public function getById($id){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare( $sql );
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            if($stmt->execute()){
                return $stmt;
            }else{
                return false;
            }
            
        }

    }

?>