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
            $stmt->execute([$prodottoId]);
            $num = $stmt->rowCount();
            print_r($num);
            if($num == 0){
                return false;
            } else {
                $prodotto = $stmt->fetch(PDO::FETCH_ASSOC);
                return $prodotto;
            }
        } 

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }

        public function getNProd($limit, $page){
            $sql = "SELECT * FROM " . $this->table_name . "LIMIT " . $page . " , " . $limit;
            $stmt = $this->conn->prepare( $sql );
            $status = $stmt->execute();
            return $stmt;
        }

    }

?>