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
            if($stmt->execute()){
                return $stmt;
            }else{
                return false;
            }
        }

        public function registerLotto(){
            $sql = "INSERT INTO " . $this->table_name . " (numero, quantita_disponibile, scadenza, id_prodotto, id_stabilimento) VALUES (:n, :q, :s, :idp, :ids)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue( ":n", $this->numero, PDO::PARAM_STR );
            $stmt->bindValue( ":q", $this->quantita_disponibile, PDO::PARAM_STR );
            $stmt->bindValue( ":s", $this->scadenza, PDO::PARAM_STR );
            $stmt->bindValue( ":idp", $this->id_prodotto, PDO::PARAM_INT );
            $stmt->bindValue( ":ids", $this->id_stabilimento, PDO::PARAM_INT );
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function get($id_prod){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id_prodotto = ? ORDER BY scadenza";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$id_prod]);
            return $stmt;
        }

        
        public function aggiornaQtaDisp($nuova_qta){
            $sql = "UPDATE " . $this->table_name . " SET quantita_disponibile = ? WHERE id = " . $this->id;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$nuova_qta]);
            return $stmt;
        }
        
    }

?>
