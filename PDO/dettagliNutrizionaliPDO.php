<?php 

    class DettagliNutrizionaliPDO{

        protected $conn;
        protected $table_name = "dettagli_nutrizionali";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getDettagliN($idProdotto){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id_prodotto = ?";
            $stmt = $this->conn->prepare( $sql );
            if($stmt->execute([$idProdotto])){
                $coso = $stmt->fetch(PDO::FETCH_ASSOC);
                return $coso;
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
    }

?>