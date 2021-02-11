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
