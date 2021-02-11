<?php 

    class ProdottoInOrdinePDO{

        protected $conn;
        protected $table_name = "prodotto_in_ordine";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getProdottoInOrdine($ordineId){​​
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id_ordine = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$ordineId]);
            return $stmt;
        }

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }
        
        public function creaProdInOrd(){
            $sql = "INSERT INTO " . $this->table_name . " (id_ordine, id_prodotto, quantita, id_lotto)
            VALUES ( ?, ?, ?, ? )";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute(array($this->id_ordine, $this->id_prodotto, $this->quantita, $this->id_lotto));
            return $stmt;
        }
    }

?>
