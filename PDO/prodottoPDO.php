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
                $coso = $stmt->fetch(PDO::FETCH_ASSOC);
                return $coso;
            }else{
                return false;
            }
        } 

        public function getProdotti(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute()){
                return $stmt;
            }else{
                return false;
            }
        }

        public function getPrezzoP($prodottoId){
            $sql = "SELECT prezzo FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare( $sql );
            if($stmt->execute([$prodottoId])){
                return $stmt;
            }else{
                return false;
            }

        }

        public function getNomeById($prodottoId){
            $sql = "SELECT nome FROM " . $this->table_name . " WHERE id = ?";
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

        public function registerProdotto(){
            $sql = "INSERT INTO " . $this->table_name . " (nome, prezzo, sconto, categoria, descrizione, id_produttore) VALUES (:n, :p, :s, :c, :d, :i)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue( ":n", $this->nome, PDO::PARAM_STR );
            $stmt->bindValue( ":p", $this->prezzo, PDO::PARAM_INT );
            $stmt->bindValue( ":s", $this->sconto, PDO::PARAM_INT );
            $stmt->bindValue( ":c", $this->id_categoria, PDO::PARAM_INT );
            $stmt->bindValue( ":d", $this->descrizione, PDO::PARAM_STR );
            $stmt->bindValue( ":i", $this->id_produttore, PDO::PARAM_INT );
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function modificaProdotto(){
            $sql = "UPDATE " . $this->table_name . " SET nome=:n, prezzo=:p, sconto=:s, categoria=:c, descrizione=:d, id_produttore=:idp WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue( ":n", $this->nome, PDO::PARAM_STR );
            $stmt->bindValue( ":p", $this->prezzo, PDO::PARAM_INT );
            $stmt->bindValue( ":s", $this->sconto, PDO::PARAM_INT );
            $stmt->bindValue( ":c", $this->id_categoria, PDO::PARAM_INT );
            $stmt->bindValue( ":d", $this->descrizione, PDO::PARAM_STR );
            $stmt->bindValue( ":idp", $this->id_produttore, PDO::PARAM_INT );
            $stmt->bindValue( ":id", $this->id, PDO::PARAM_INT );
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function eliminaProdotto($id){
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