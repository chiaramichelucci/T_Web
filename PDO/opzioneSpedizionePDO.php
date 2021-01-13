<?php 

    class OpzioneSpedizionePDO{

        protected $conn;
        protected $table_name = "opzione_spedizione";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }
    }

?>