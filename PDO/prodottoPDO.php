<?php 

    class ProdottoPDO{

        protected $conn;
        protected $table_name = "prodotto";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getProdotto($prodottoId){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare( $sql );
            if($stmt->execute([$prodottoId])){
                return $stmt;
            }else{
                return false;
            }
        } 

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }

        public function getNProd($page, $limit){
            $sql = "SELECT * FROM " . $this->table_name . " ORDER BY id LIMIT :offset, :row ";
            $stmt = $this->conn->prepare( $sql );
            $stmt->bindValue( ":offset", $page, PDO::PARAM_INT );
            $stmt->bindValue( ":row", $limit, PDO::PARAM_INT );
            $status = $stmt->execute();
            return $stmt;
        }

    }

?>