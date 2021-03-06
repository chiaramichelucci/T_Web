<?php 

    class CategoriaPDO{

        protected $conn;
        protected $table_name = "categoria";

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

        public function getbyId($id){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id= :id";
            $stmt = $this->conn->prepare( $sql );
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            if($stmt->execute()){
                return $stmt;
            }else{
                return false;
            }
            
        }

        public function getIdCat($nome){
            $sql = "SELECT id FROM " . $this->table_name . " WHERE nome= :nome";
            $stmt = $this->conn->prepare( $sql );
            $stmt->bindValue(":nome", $nome, PDO::PARAM_STR);
            if($stmt->execute()){
                return $stmt;
            }else{
                return false;
            }
            
        }
    }

?>