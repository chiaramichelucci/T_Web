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

        public function registerProduttore(){
            $sql = "INSERT INTO " . $this->table_name . " (ragione_sociale, partita_iva, prefisso, numero_verde, email, sito) VALUES (:rs, :piva, :pre, :nr, :e, :s)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue( ":rs", $this->ragione_sociale, PDO::PARAM_STR );
            $stmt->bindValue( ":piva", $this->partita_iva, PDO::PARAM_STR );
            $stmt->bindValue( ":pre", $this->prefisso, PDO::PARAM_STR );
            $stmt->bindValue( ":nr", $this->numero_verde, PDO::PARAM_INT );
            $stmt->bindValue( ":e", $this->email, PDO::PARAM_STR );
            $stmt->bindValue( ":s", $this->sito, PDO::PARAM_STR );
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function modificaProduttore(){
            $sql = "UPDATE " . $this->table_name . " SET ragione_sociale=:rs, partita_iva=:piva, prefisso=:pre, numero_verde=:nr, email=:e, sito=:s WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue( ":rs", $this->ragione_sociale, PDO::PARAM_STR );
            $stmt->bindValue( ":piva", $this->partita_iva, PDO::PARAM_STR );
            $stmt->bindValue( ":pre", $this->prefisso, PDO::PARAM_STR );
            $stmt->bindValue( ":nr", $this->numero_verde, PDO::PARAM_INT );
            $stmt->bindValue( ":e", $this->email, PDO::PARAM_STR );
            $stmt->bindValue( ":s", $this->sito, PDO::PARAM_STR );
            $stmt->bindValue( ":id", $this->id, PDO::PARAM_INT );
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function eliminaProduttore($id){
            $sql = "DELETE FROM " . $this->table_name . " WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue( ":id", $id, PDO::PARAM_INT );
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

    }

?>