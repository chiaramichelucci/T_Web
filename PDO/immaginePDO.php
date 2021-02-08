<?php 

    class ImmaginePDO{

        protected $conn;
        protected $table_name = "immagine";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getByProdId($idProd){
            $sql = "SELECT url AS url_prod_img FROM " . $this->table_name . " WHERE id_prodotto = :id";
            $stmt = $this->conn->prepare( $sql );
            $stmt->bindValue( ":id", $idProd, PDO::PARAM_INT );
            $stmt->execute();
            return $stmt;
        }
    }

?>